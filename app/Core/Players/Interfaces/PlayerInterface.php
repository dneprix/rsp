<?php

namespace App\Core\Players\Interfaces;

use App\Core\Tools\Interfaces\ToolInterface;

/**
 * Interface PlayerInterface
 * @package App\Core\Players\Interfaces
 */
interface PlayerInterface
{
    /**
     *  Player play
     */
    public function play(): void;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return ToolInterface
     */
    public function getState(): ToolInterface;
}
