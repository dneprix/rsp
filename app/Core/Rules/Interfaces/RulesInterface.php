<?php

namespace App\Core\Rules\Interfaces;

/**
 * Interface RulesInterface
 * @package App\Core\Rules\Interfaces
 */
interface RulesInterface
{
    const RESULT_TIE = 'TIE';
    const RESULT_WIN = 'WIN';
    const RESULT_LOST = 'LOST';

    /**
     * @param $players
     * @return iterable
     */
    public function getResult($players):iterable;
}
