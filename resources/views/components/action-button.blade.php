@if($method === 'GET')
    <a href="{{ $route }}" class="border rounded-sm pt-1 pb-1 pl-2 pr-2 mr-2 cursor-pointer">{{ $title }}</a>
@else
    <form
        action="{{ $route }}"
        method="{{ $method }}"
        class="inline-block"
    >
        @csrf
        <button type="submit" class="border rounded-sm pt-1 pb-1 pl-2 pr-2 mr-2 cursor-pointer">{{ $title }}</button>
    </form>
@endif
