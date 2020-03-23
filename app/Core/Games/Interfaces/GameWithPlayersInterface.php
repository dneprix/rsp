<?php

namespace App\Core\Games\Interfaces;
use App\Core\Players\Interfaces\PlayerInterface;

/**
 * Interface GameWithPlayersInterface
 * @package App\Core\Games\Interfaces
 */
interface GameWithPlayersInterface
{
    /**
     * @param PlayerInterface ...$players
     */
    public function addPlayers(PlayerInterface ...$players): void;
}
