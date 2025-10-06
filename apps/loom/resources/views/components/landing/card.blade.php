@props([
    'title',
    'icon' => null,
    'content' => null,
])
<div {{ $attributes->class('p-8 rounded-2xl bg-gray-100 dark:bg-gray-900 border border-gray-300 dark:border-gray-700 hover:scale-105 transition-transform') }}>
    @isset($image)
    <img src="https://source.unsplash.com/random/400x250?dashboard" alt="{{ $title }}" class="w-full" />
    @endisset
    @isset($image)
    <div class="p-6">
    @endisset
    <h3 @class(['text-xl font-semibold', 'mb-4' => !isset($image), 'mb-2' => isset($image)])>
        @isset($icon)
        {!! $icon !!}
        @endisset
        @lang($title)
    </h3>
    @isset($content)
    <p class="text-gray-600 dark:text-gray-400">@lang($content)</p>
    @endisset
    @isset($image)
    </div>
    @endisset
    {{ $slot }}
</div>
