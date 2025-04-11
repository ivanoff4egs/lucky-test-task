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

    public function regenerate(Player $player): RedirectResponse
    {
        list($link_id, $link_expires_at) = array_values($this->playerService->generateLink());
        $player->link_id = $link_id;
        $player->link_expires_at = $link_expires_at;
        $player->save();

        return redirect()->route(
            'game.index',
            ['link_id' => $link_id]
        )->with('success', 'Your link has been regenerated');
    }

    public function invalidate(Player $player): RedirectResponse
    {
        $player->link_id = null;
        $player->link_expires_at = null;
        $player->save();

        return redirect()->route('player.index')->with('success', 'Your link has been invalidated');
    }
}
