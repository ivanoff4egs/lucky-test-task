<?php

namespace App\Services;

use App\Enums\GameResult;
use App\Models\Game;

class GameService
{
    public function play(Game $game): Game
    {
        $game->value = rand(1,1000);

        return $game;
    }

    public function setResult(Game $game): Game
    {
        $game->result = $game->value % 2 === 0 ? GameResult::WIN : GameResult::LOSE;

        return $game;
    }

    public function setCoins(Game $game): Game
    {
        if ($game->result == GameResult::WIN) {
            if ($game->value > 900) {
                $game->coins = round($game->value * 0.7, 2);
            } elseif ($game->value > 600) {
                $game->coins = round($game->value * 0.5, 2);
            } elseif ($game->value > 300) {
                $game->coins = round($game->value * 0.3, 2);
            } else {
                $game->coins = round($game->value * 0.1, 2);
            }
        }

        return $game;
    }
}
