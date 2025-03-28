@extends('layouts.app')
@section('title') Play Game @endsection
@section('content')
    <div>
        @if(\Illuminate\Support\Facades\Session::has('success'))
            <div class="text-green-400 flex justify-center mb-5">{{ \Illuminate\Support\Facades\Session::get('success') }}</div>
        @endif
        @if(\Illuminate\Support\Facades\Session::has('fail'))
            <div class="text-red-400 flex justify-center mb-5">{{ \Illuminate\Support\Facades\Session::get('fail') }}</div>
        @endif

        <span class="mr-2">Your link: </span>
        <span class="mr-4"><a class="text-blue-400" href="{{ $player->link }}">{{ $player->link }}</a></span>
        <x-action-button
            route="{{ route('player.link.regenerate', ['player_id' => $player->id]) }}"
            title="Regenerate link"
        />
        <x-action-button
            route="{{ route('player.link.invalidate', ['player_id' => $player->id]) }}"
            title="Invalidate link"
        />

        <div class="mt-5 flex justify-center">
            <x-action-button
                route="{{ route('game.play', ['player_id' => $player->id]) }}"
                title="I`m feeling lucky"
            />
            <x-action-button
                route="{{ route('game.history', ['player_id' => $player->id]) }}"
                title="History"
                method="GET"
            />
        </div>

    </div>
@endsection
