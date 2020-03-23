<?php

namespace App\Core\Tools;

use App\Core\Tools\Interfaces\ToolInterface;

/**
 * Class AbstractTool
 * @package App\Core\Tools
 */
abstract class AbstractTool implements ToolInterface
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }
}
