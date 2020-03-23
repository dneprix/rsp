<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Core\Games\Game;

class GameServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the game services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the game services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Game::class, function () {
            return new Game();
        });
    }
}
