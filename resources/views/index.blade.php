@extends('layouts.app')
@section('title') Register @endsection
@section('content')
    <form action="{{ route('player.register') }}" method="POST">
        @if(\Illuminate\Support\Facades\Session::has('success'))
            <div class="text-green-500 flex justify-center mb-2">{{ \Illuminate\Support\Facades\Session::get('success') }}</div>
        @endif
        @if(\Illuminate\Support\Facades\Session::has('fail'))
            <div class="text-green-500 flex justify-center mb-2">{{ \Illuminate\Support\Facades\Session::get('fail') }}</div>
        @endif
        @csrf
        <div class="mb-2 grid grid-cols-2 gap-3">
            <label for="username">Username:</label>
            <input class="border pl-2 pr-2 rounded-sm {{ $errors->has('username') ? 'border-red-800 border-2 text-red-800' : '' }}"
                   type="text"
                   name="username"
                   id="username"
                   value="{{ old('username') }}"
                   placeholder="2-100 symbols"
            >
            @error('username')
                <div class="col-span-2 text-red-800 flex justify-end">{{ $message }}</div>
            @enderror

            <label for="phone_number">Phone number:</label>
            <input class="border pl-2 pr-2 rounded-sm {{ $errors->has('phone_number') ? 'border-red-800 border-2 text-red-800' : '' }}"
                   type="text"
                   name="phone_number"
                   id="phone_number"
                   value="{{ old('phone_number') }}"
                   placeholder="7-12 digits"
            >
            @error('phone_number')
                <div class="col-span-2 text-red-800 flex justify-end">{{ $message }}</div>
            @enderror
            <div class="col-span-2 flex justify-end">
                <button class="border rounded-sm pt-1 pb-1 pl-2 pr-2 cursor-pointer" type="submit">Register</button>
            </div>
        </div>
    </form>
@endsection
