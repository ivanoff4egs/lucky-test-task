<?php

namespace App\Http\Controllers;

use App\Enums\GameResult;
use App\Models\Game;
use App\Models\Player;
use App\Services\GameService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class GameController extends Controller
{
    protected GameService $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function index(string $link_id): RedirectResponse|Response|View
    {
        $player = Player::query()->where('link_id', $link_id)->first();
        if (!$player) {
            abort(Response::HTTP_NOT_FOUND);
        }

        if ($player->is_link_expired) {
            return redirect()->route('player.index')->with('fail', 'Link has expired');
        }

        return view('game', ['player' => $player]);
    }

    public function play(int $player_id): RedirectResponse
    {
        $player = Player::find($player_id);

        if (!$player) {
            abort(Response::HTTP_NOT_FOUND);
        }

        if ($player->is_link_expired) {
            return redirect()->route('player.index')->with('fail', 'Link has expired');
        }

        $game = new Game(['player_id' => $player->id]);
        $game = $this->gameService->play($game);
        $game = $this->gameService->setResult($game);
        $game = $this->gameService->setCoins($game);
        $game->save();

        if ($game->result == GameResult::LOSE) {
            $messageKey = 'fail';
            $message = 'You lose!';
        } else {
            $messageKey = 'success';
            $message = sprintf("Congratulations! You WIN %0.2f coins!", $game->coins);
        }

        return redirect()->route('game.index', ['link_id' => $player->link_id])->with($messageKey, $message);
    }

    public function history(int $player_id)
    {
        $player = Player::find($player_id);

        if (!$player) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $games = $player->games->sortByDesc('created_at')->take(3);
        return view('history', ['games' => $games, 'player' => $player]);
    }
}
