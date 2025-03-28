@extends('layouts.app')
@section('title') History @endsection
@section('content')
    <table class="w-2/3">
        <tr>
            <th colspan="4" class="font-bold text-lg text-left pb-3">
                <x-action-button
                    route="{{route('game.index', ['link_id' => $player->link_id])}}"
                    title="<- Back"
                    method="GET"
                />
            </th>
        </tr>
        <tr>
            <th colspan="4" class="font-bold text-lg text-left pb-3">
                Last 3 games:
            </th>
        </tr>
        <tr class="border-b">
            <th class="text-center border-r w-64">Date</th>
            <th class="text-center border-r">Value</th>
            <th class="text-center border-r">Result</th>
            <th class="text-center">Coins</th>
        </tr>
        @foreach($games ?? [] as $game)
            <tr class="{{ $game->result == \App\Enums\GameResult::WIN->value ? 'text-green-400' : 'text-red-400' }}">
                <td class="text-center border-r">{{ $game->created_at }}</td>
                <td class="text-center border-r">{{ $game->value }}</td>
                <td class="text-center border-r">{{ $game->result }}</td>
                <td class="text-center">{{ $game->coins }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4">

            </td>
        </tr>
    </table>
    <div>

    </div>

@endsection
