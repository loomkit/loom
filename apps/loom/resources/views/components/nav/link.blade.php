@props([
    'href',
    'text',
    'mobile' => false,
])
<a href="{{ $href }}" {{ $attributes->class([
    'hover:text-black dark:hover:text-white',
    'block py-2 text-gray-700 dark:text-gray-300' => $mobile
    ]) }}>
    @lang($text)
</a>
