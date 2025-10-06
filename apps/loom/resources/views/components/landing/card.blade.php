@props([
    'title',
    'icon' => null,
    'content' => null,
    'highlight' => false,
])
<div {{ $attributes->class(['p-8 rounded-2xl bg-gray-100 dark:bg-gray-900 hover:scale-105 transition-transform', 'border border-gray-200 dark:border-gray-700' => !$highlight, 'border-2 border-blue-500' => $highlight]) }}>
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
