<?php

namespace App\Core\Rules;

use App\Core\Tools\PaperTool;
use App\Core\Tools\ScissorsTool;
use Mockery;

use App\Core\Players\Player;
use App\Core\Tools\RockTool;

class CommonRulesTest extends \TestCase
{

    public function testGetResultTieSuccess()
    {
        $playerMock1 = Mockery::mock(Player::class);
        $playerMock1
            ->shouldReceive('getState')->andReturn(new RockTool())
            ->shouldReceive('getName')->andReturn('Player1');

        $playerMock2 = Mockery::mock(Player::class);
        $playerMock2
            ->shouldReceive('getState')->andReturn(new RockTool())
            ->shouldReceive('getName')->andReturn('Player2');

        $rules = new CommonRules();
        $result = $rules->getResult([$playerMock1, $playerMock2]);

        $this->assertEquals($result['TIE'], 'TIE');
    }

    public function testGetResultWinSuccess()
    {
        $playerMock1 = Mockery::mock(Player::class);
        $playerMock1
            ->shouldReceive('getName')->andReturn('Player1')
            ->shouldReceive('getState')->andReturn(new PaperTool());

        $playerMock2 = Mockery::mock(Player::class);
        $playerMock2
            ->shouldReceive('getName')->andReturn('Player2')
            ->shouldReceive('getState')->andReturn(new RockTool());

        $rules = new CommonRules();
        $result = $rules->getResult([$playerMock1, $playerMock2]);

        $this->assertEquals($result['WIN'], 'Player1');
    }

    public function testGetResultWinThreePlayersSuccess()
    {
        $playerMock1 = Mockery::mock(Player::class);
        $playerMock1
            ->shouldReceive('getName')->andReturn('Player1')
            ->shouldReceive('getState')->andReturn(new ScissorsTool());

        $playerMock2 = Mockery::mock(Player::class);
        $playerMock2
            ->shouldReceive('getName')->andReturn('Player2')
            ->shouldReceive('getState')->andReturn(new ScissorsTool());

        $playerMock3 = Mockery::mock(Player::class);
        $playerMock3
            ->shouldReceive('getName')->andReturn('Player3')
            ->shouldReceive('getState')->andReturn(new RockTool());

        $rules = new CommonRules();
        $result = $rules->getResult([$playerMock1, $playerMock2, $playerMock3]);

        $this->assertEquals($result['WIN'], 'Player3');
    }

    public function testGetResultTieThreePlayersSuccess()
    {
        $playerMock1 = Mockery::mock(Player::class);
        $playerMock1
            ->shouldReceive('getName')->andReturn('Player1')
            ->shouldReceive('getState')->andReturn(new ScissorsTool());

        $playerMock2 = Mockery::mock(Player::class);
        $playerMock2
            ->shouldReceive('getName')->andReturn('Player2')
            ->shouldReceive('getState')->andReturn(new PaperTool());

        $playerMock3 = Mockery::mock(Player::class);
        $playerMock3
            ->shouldReceive('getName')->andReturn('Player3')
            ->shouldReceive('getState')->andReturn(new RockTool());

        $rules = new CommonRules();
        $result = $rules->getResult([$playerMock1, $playerMock2, $playerMock3]);

        $this->assertEquals($result['TIE'], 'TIE');
    }
}
