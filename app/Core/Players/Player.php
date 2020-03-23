<?php

namespace App\Core\Players;

use App\Core\Players\Interfaces\PlayerInterface;
use App\Core\Tools\Interfaces\ToolInterface;

/**
 * Class Player
 * @package App\Core\Players
 */
class Player implements PlayerInterface
{
    private $options;
    private $state;

    /**
     * Player constructor.
     * @param $options
     */
    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * Player play
     */
    public function play(): void
    {
        $strategy = $this->options[Options::STRATEGY_KEY];
        $strategyStates = Options::$strategyStatesMap[$strategy];
        $this->state = new $strategyStates[array_rand($strategyStates)];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->options[Options::NAME_KEY];
    }

    /**
     * @return ToolInterface
     */
    public function getState(): ToolInterface
    {
        return $this->state;
    }


}
