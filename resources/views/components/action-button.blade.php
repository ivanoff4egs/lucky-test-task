<form
    action="{{ $route }}"
    method="POST"
    class="inline-block"
>
    @csrf
    <button type="submit" class="border rounded-sm pt-1 pb-1 pl-2 pr-2 mr-2 cursor-pointer">{{ $title }}</button>
</form>

