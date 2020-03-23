<?php

namespace App\Core\Players;

use App\Core\Tools\PaperTool;
use App\Core\Tools\RockTool;
use App\Core\Tools\ScissorsTool;

/**
 * Class Options
 * @package App\Core\Players
 */
class Options
{
    const NAME_KEY = 'NAME';
    const STRATEGY_KEY = 'STRATEGY';

    const STRATEGY_PAPER = 'STRATEGY_PAPER';
    const STRATEGY_RANDOM = 'STRATEGY_RANDOM';

    /**
     * Map strategy states
     * @var array
     */
    public static $strategyStatesMap = [
        self::STRATEGY_PAPER => [PaperTool::class],
        self::STRATEGY_RANDOM => [RockTool::class, ScissorsTool::class, PaperTool::class],
    ];
}
