@props([
    'title',
    'icon' => null,
    'content',
    'price',
    'href',
    'action' => null,
    'features' => [],
])
<x-landing.card :$title :$icon :$content {{ $attributes }}>
    @isset($price)
    <p class="text-3xl font-extrabold mt-6">{{ $price }} XOF <span class="text-lg font-normal">/month</span></p>
    @endisset
    {{ $slot }}
    <ul class="space-y-2 text-gray-600 dark:text-gray-400 mt-6">
        @foreach($features as $feature)
        <li>✔️ @lang($feature)</li>
        @endforeach
    </ul>
    <a href="{{ $href }}" class="block mt-6 px-6 py-3 rounded-2xl bg-blue-400 dark:bg-blue-600 hover:bg-blue-500">@lang($action)</a>
</x-landing.card>
