<?php

namespace App\Core\Games\Interfaces;


/**
 * Interface GameInterface
 * @package App\Core\Games\Interfaces
 */
interface GameInterface
{
    const ERROR_INVALID = 'invalid';

    /**
     * Play
     */
    public function play(): void;


    /**
     * @return iterable
     */
    public function getResult(): iterable;
}
