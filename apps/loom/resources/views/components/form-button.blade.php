@props([
    'type' => 'submit',
    'value',
])
<button type="{{ $type }}" class="w-full py-3 rounded-2xl bg-blue-500 hover:bg-blue-400 font-semibold">@lang($value)</button>
