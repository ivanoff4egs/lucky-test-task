<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\PlayerController::class, 'index'])->name('player.index');
Route::post('/register', [\App\Http\Controllers\PlayerController::class, 'register'])->name('player.register');

Route::post(
    '/link/regenerate/{player_id}',
    [\App\Http\Controllers\PlayerController::class, 'regenerate']
)->name('player.link.regenerate');

Route::post(
    '/link/invalidate/{player_id}',
    [\App\Http\Controllers\PlayerController::class, 'invalidate']
)->name('player.link.invalidate');

Route::get('/game/{link_id}', [\App\Http\Controllers\GameController::class, 'index'])->name('game');
Route::post('/game/play/{player_id}', [\App\Http\Controllers\GameController::class, 'play'])->name('game.play');
Route::get(
    '/game/history/{player_id}',
    [\App\Http\Controllers\GameController::class, 'history']
)->name('game.history');
