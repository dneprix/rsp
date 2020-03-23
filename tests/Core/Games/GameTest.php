<?php

namespace App\Core\Games;

use App\Core\Players\Options;
use App\Core\Players\Player;
use App\Core\Rules\CommonRules;

use App\Core\Tools\RockTool;
use \Mockery;


class GameTest extends \TestCase
{

    public function testGetResultSuccess()
    {
        $game = new Game();
        $expected = ['test result'];

        // Set private property result
        $reflector = new \ReflectionClass($game);
        $reflector_property = $reflector->getProperty('result');
        $reflector_property->setAccessible(true);
        $reflector_property->setValue($game, $expected);

        // Check result
        $this->assertEquals($expected, $game->getResult());
        $this->assertNotEquals(null, $game->getResult());
    }

    public function testGetResultFail()
    {
        $game = new Game();
        $expected = 'test result';

        // Set private property result
        $reflector = new \ReflectionClass($game);
        $reflector_property = $reflector->getProperty('result');
        $reflector_property->setAccessible(true);
        $reflector_property->setValue($game, $expected);

        // Check result
        $this->expectExceptionMessage('must be iterable');
        $game->getResult();
    }

    public function testAddPlayersSuccess()
    {
        $game = new Game();
        $player1 = new Player([Options::NAME_KEY => 'Player1']);
        $player2 = new Player([Options::NAME_KEY => 'Player2']);

        // Add players 1 and 2
        $game->addPlayers($player1, $player2);

        // Get private property players
        $reflector = new \ReflectionClass($game);
        $reflector_property = $reflector->getProperty('players');
        $reflector_property->setAccessible(true);
        $players = $reflector_property->getValue($game);

        // Check player 1 and 2
        $this->assertEquals($player1, $players[0]);
        $this->assertEquals($player2, $players[1]);

        // Check wrong player 1
        $this->assertNotEquals($player1, $players[1]);

        // Add player 3
        $player3 = new Player([Options::NAME_KEY => 'Player3']);
        $game->addPlayers($player3);

        // Check player 3
        $players = $reflector_property->getValue($game);
        $this->assertEquals($player3, $players[2]);
    }

    public function testAddPlayersFail()
    {
        $game = new Game();

        // Add wrong player
        $this->expectExceptionMessage('must implement interface');
        $wrongPlayerObject = new CommonRules();
        $game->addPlayers($wrongPlayerObject);
    }

    public function testSetRulesSuccess()
    {
        $game = new Game();
        $expected = new CommonRules();

        // Set rules
        $game->setRules($expected);

        // Get private property rules
        $reflector = new \ReflectionClass($game);
        $reflector_property = $reflector->getProperty('rules');
        $reflector_property->setAccessible(true);
        $actual = $reflector_property->getValue($game);

        // Check rules
        $this->assertEquals($expected, $actual);
    }

    public function testSetRulesFail()
    {
        $game = new Game();
        $expected = new Player([]);

        // Set wrong rules
        $this->expectExceptionMessage('must implement interface');
        $game->setRules($expected);
    }

    public function testPlaySuccess()
    {
        $game = new Game();

        $player2 = new Player([
            Options::NAME_KEY => 'Player2',
            Options::STRATEGY_KEY => Options::STRATEGY_PAPER,
        ]);

        $playerMock1 = Mockery::mock(Player::class);
        $playerMock1
            ->shouldReceive('play')->once()
            ->shouldReceive('getState')->andReturn(new RockTool())
            ->shouldReceive('getName')->andReturn('Player1');

        // Add players 1 and 2
        $game->addPlayers($playerMock1, $player2);

        // Set Rules
        $game->setRules(new CommonRules());
        $game->play();

        // Get Results
        $result = $game->getResult();

        // Check winner
        $this->assertEquals($result['WIN'], 'Player2');
    }

    public function testPlayFail()
    {
        $game = new Game();
        $this->expectExceptionMessage('invalid');
        $game->play();
    }


}
