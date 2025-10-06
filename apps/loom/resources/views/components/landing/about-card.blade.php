@props([
    'title',
    'icon' => null,
    'content' => null,
])
<x-landing.card :$title :$icon :$content {{ $attributes->class('bg-gradient-to-tr from-indigo-300/20 dark:from-indigo-700/20 to-purple-300/20 dark:to-purple-700/20') }}>
    {{ $slot }}
</x-landing>
