<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlayerRequest;
use App\Models\Player;
use App\Services\PlayerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PlayerController extends Controller
{
    protected PlayerService $playerService;

    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    public function index(): View
    {
        return view('index');
    }

    public function register(StorePlayerRequest $request): RedirectResponse
    {
        $playerData = $request->validated();
        $playerData = array_merge($playerData, $this->playerService->generateLink());
        $player = Player::updateOrCreate(
            [
                'username' => $playerData['username'],
                'phone_number' => $playerData['phone_number']
            ],
            $playerData
        );

        return redirect()->route('game.index', ['link_id' => $player->link_id]);
    }

    public function regenerate(string $player_id): RedirectResponse
    {
        $user = Player::find($player_id);
        list($link_id, $link_expires_at) = array_values($this->playerService->generateLink());
        $user->link_id = $link_id;
        $user->link_expires_at = $link_expires_at;
        $user->save();

        return redirect()->route(
            'game',
            ['link_id' => $link_id]
        )->with('success', 'Your link has been regenerated');
    }

    public function invalidate(string $player_id): RedirectResponse
    {
        $user = Player::find($player_id);
        $user->link_id = null;
        $user->link_expires_at = null;
        $user->save();

        return redirect()->route('player.index')->with('success', 'Your link has been invalidated');
    }
}
