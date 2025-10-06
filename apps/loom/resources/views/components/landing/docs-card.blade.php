@props([
    'title',
    'icon' => null,
    'content',
    'action' => null,
])
<x-landing.card :$title :$icon :$content {{ $attributes->class('hover:scale-105 transition-transform') }}>
    {{ $slot }}
    <a href="https://loomkit.github.io" class="inline-block mt-6 px-4 py-2 rounded-xl bg-blue-500 hover:bg-blue-400 font-semibold">@lang($action ?? 'Read More')</a>
</x-landing>
