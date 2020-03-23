<?php

namespace App\Console\Commands\Games;

use App\Core\Players\Player;
use App\Core\Players\Options;
use App\Core\Rules\CommonRules;
use Illuminate\Console\Command;

use App\Core\Games\Game;

/**
 * Class RspPlayCommand
 * @package App\Console\Commands\Games
 */
class RspPlayCommand extends Command
{
    protected $signature = 'games:rsp:play {rounds=1}';
    protected $description = 'Play game';

    /**
     *  Handle play RSP game
     */
    public function handle(Game $game)
    {
        // Create Player A
        $playerA = new Player([
            Options::NAME_KEY => 'Player A',
            Options::STRATEGY_KEY => Options::STRATEGY_PAPER
        ]);

        // Create Player B
        $playerB = new Player([
            Options::NAME_KEY => 'Player B',
            Options::STRATEGY_KEY => Options::STRATEGY_RANDOM
        ]);

        // Add players to game
        $game->addPlayers($playerA, $playerB);

        // Set rules to game
        $game->setRules(new CommonRules());

        // Play game rounds
        $rounds = $this->argument('rounds');
        while ($rounds) {
            try {
                $game->play();
                $this->info("Play: ". json_encode($game->getResult()));
            } catch
            (\Exception $e) {
                $this->error($e->getMessage());
            }
            $rounds--;
        }
    }
}
