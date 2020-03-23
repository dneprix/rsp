<?php

namespace App\Core\Rules;

use App\Core\Players\Interfaces\PlayerInterface;
use App\Core\Rules\Interfaces\RulesInterface;
use App\Core\Tools\PaperTool;
use App\Core\Tools\RockTool;
use App\Core\Tools\ScissorsTool;

/**
 * Class CommonRules
 * @package App\Core\Rules
 */
class CommonRules implements RulesInterface
{
    /**
     * @var array
     */
    private $winFirstState = [
        [PaperTool::NAME, RockTool::NAME],
        [RockTool::NAME, ScissorsTool::NAME],
        [ScissorsTool::NAME, PaperTool::NAME],
    ];

    /**
     * @param $players
     * @return iterable
     */
    public function getResult($players): iterable
    {
        $result = [];
        foreach ($players as $player) {
            $result[$player->getName()] = $player->getState()->getName();
        }

        $winner = $this->findWinner($players);
        if ($winner) {
            $result[self::RESULT_WIN] = $winner->getName();
        } else {
            $result[self::RESULT_TIE] = self::RESULT_TIE;
        }

        return $result;
    }

    /**
     * @param $players
     * @return PlayerInterface|null
     */
    private function findWinner($players): ?PlayerInterface
    {
        foreach ($players as $playerFirst) {
            $playerResults = [];
            foreach ($players as $playerSecond) {
                if ($playerFirst->getName() == $playerSecond->getName()) {
                    continue;
                }

                $res = $this->getStatesResult($playerFirst->getState(), $playerSecond->getState());
                $playerResults[$res] = !empty($playerResults[$res]) ? $playerResults[$res] + 1 : 1;
            }
            if (isset($playerResults[self::RESULT_WIN]) && $playerResults[self::RESULT_WIN] == count($players) - 1) {
                return $playerFirst;
            }
        }
        return null;
    }


    /**
     * @param $firstState
     * @param $secondState
     * @return string
     */
    private function getStatesResult($firstState, $secondState): string
    {
        if ($firstState->getName() == $secondState->getName()) {
            return self::RESULT_TIE;
        }
        $win = array_search([$firstState->getName(), $secondState->getName()], $this->winFirstState);
        if ($win !== false) {
            return self::RESULT_WIN;
        }

        return self::RESULT_LOST;
    }
}
