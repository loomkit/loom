@props([
    'href',
    'text',
    'mobile' => false,
])
<a href="{{ $href }}" {{ $attributes->class([
    'cursor-pointer px-4 py-2 rounded-xl bg-blue-500 hover:bg-blue-600 dark:hover:bg-blue-400 font-semibold',
    'hidden md:inline-block' => !$mobile,
    'block' => $mobile,
    ]) }}>
    @lang($text)
    {{ $slot }}
</a>
