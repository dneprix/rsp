<?php

namespace App\Core\Players;


use App\Core\Tools\PaperTool;
use App\Core\Tools\RockTool;

class PlayerTest extends \TestCase
{

    public function testPlayPaperSuccess()
    {
        // Create player
        $player = new Player([
            Options::NAME_KEY => 'Player',
            Options::STRATEGY_KEY => Options::STRATEGY_PAPER]);

        // Player play
        $player->play();

        // Check state
        $actual = $player->getState();
        $expected = new PaperTool();
        $this->assertEquals($expected, $actual);
    }

    public function testPlayRandomSuccess()
    {
        // Create player
        $player = new Player([
            Options::NAME_KEY => 'Player',
            Options::STRATEGY_KEY => Options::STRATEGY_RANDOM]);

        // Player play
        $player->play();

        // Get actual state
        $actual = $player->getState();

        // Get list expected states
        $expected = [];
        foreach (Options::$strategyStatesMap[Options::STRATEGY_RANDOM] as $tool) {
            $expected[] = new $tool;
        }

        // Check state
        $this->assertContainsEquals($actual, $expected);

    }

    public function testPlayFail()
    {
        // Create player
        $player = new Player([]);

        // Check
        $this->expectExceptionMessage('Undefined');
        $player->play();
    }

    public function testGetStateSuccess()
    {
        $player = new Player([]);
        $expected = new RockTool();

        // Set private property state
        $reflector = new \ReflectionClass($player);
        $reflector_property = $reflector->getProperty('state');
        $reflector_property->setAccessible(true);
        $reflector_property->setValue($player, $expected);

        // Check state
        $actual = $player->getState();
        $this->assertEquals($expected, $actual);
    }

    public function testGetStateFail()
    {
        $player = new Player([]);
        // Check state
        $this->expectExceptionMessage('must implement interface');
        $player->getState();
    }

    public function testGetName()
    {
        $expected = 'Player';
        $player = new Player([Options::NAME_KEY => $expected]);

        // Check name
        $actual = $player->getName();
        $this->assertEquals($expected, $actual);
    }
}
