<?php

namespace App\Core\Games;

use App\Core\Games\Interfaces\GameInterface;
use App\Core\Games\Interfaces\GameWithPlayersInterface;
use App\Core\Games\Interfaces\GameWithRulesInterface;
use App\Core\Players\Interfaces\PlayerInterface;
use App\Core\Rules\Interfaces\RulesInterface;


/**
 * Class Game
 * @package App\Core\Games
 */
class Game implements GameInterface, GameWithPlayersInterface, GameWithRulesInterface
{
    private $players = [];
    private $result;
    private $rules;

    /**
     * @param PlayerInterface ...$players
     */
    public function addPlayers(PlayerInterface ...$players): void
    {
        $this->players = array_merge($this->players, $players);
    }

    /**
     * @param RulesInterface $rules
     */
    public function setRules(RulesInterface $rules): void
    {
        $this->rules = $rules;
    }

    /**
     * Play method
     */
    public function play(): void
    {
        if (empty($this->rules) || empty($this->players)) {
            throw new \Exception(self::ERROR_INVALID);
        }

        foreach ($this->players as $player) {
            $player->play();
        }
        $this->result = $this->rules->getResult($this->players);
    }

    /**
     * @return iterable
     */
    public function getResult(): iterable
    {
        return $this->result;
    }

}
