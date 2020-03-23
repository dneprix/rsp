<?php

namespace App\Core\Games\Interfaces;

use App\Core\Rules\Interfaces\RulesInterface;

/**
 * Interface GameWithRulesInterface
 * @package App\Core\Games\Interfaces
 */
interface GameWithRulesInterface
{
    /**
     * @param RulesInterface $rules
     */
    public function setRules(RulesInterface $rules): void;
}
