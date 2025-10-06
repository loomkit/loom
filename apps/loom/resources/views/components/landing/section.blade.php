@props([
    'id',
    'title',
    'tagline' => null,
    'gradient' => null,
    'color' => null,
    'from' => null,
    'via' => null,
    'to' => null,
])
@php
if ($color) {
    $attributes = $attributes->class(match($color) {
        'emerald' => 'bg-emerald-100 dark:bg-emerald-900',
        'teal' => 'bg-teal-100 dark:bg-teal-900',
        'cyan' => 'bg-cyan-100 dark:bg-cyan-900',
        'sky' => 'bg-sky-100 dark:bg-sky-900',
        'blue' => 'bg-blue-100 dark:bg-blue-900',
        'indigo' => 'bg-indigo-100 dark:bg-indigo-900',
        'violet' => 'bg-violet-100 dark:bg-violet-900',
        'purple' => 'bg-purple-100 darbg-purple-blue-900',
        default => 'bg-white dark:bg-black',
    });
}
if ($gradient) {
    $attributes = $attributes->class(match($gradient) {
        'to-t' => 'bg-gradient-to-t',
        'to-tr' => 'bg-gradient-to-tr',
        'to-tl' => 'bg-gradient-to-tl',
        'to-b' => 'bg-gradient-to-b',
        'to-br' => 'bg-gradient-to-br',
        'to-bl' => 'bg-gradient-to-bl',
    })
    ->class(match($from) {
        'emerald' => 'from-emerald-50 dark:from-emerald-950',
        'teal' => 'from-teal-50 dark:from-teal-950',
        'cyan' => 'from-cyan-50 dark:from-cyan-950',
        'sky' => 'from-sky-50 dark:from-sky-950',
        'blue' => 'from-blue-50 dark:from-blue-950',
        'indigo' => 'from-indigo-50 dark:from-indigo-950',
        'violet' => 'from-violet-50 dark:from-violet-950',
        'purple' => 'from-purple-50 dark:from-purple-950',
        'pure' => 'from-white dark:from-black',
        default => '',
    })
    ->class(match($via) {
        'emerald' => 'via-emerald-50 dark:via-emerald-950',
        'teal' => 'via-teal-50 dark:via-teal-950',
        'cyan' => 'via-cyan-50 dark:via-cyan-950',
        'sky' => 'via-sky-50 dark:via-sky-950',
        'blue' => 'via-blue-50 dark:via-blue-950',
        'indigo' => 'via-indigo-50 dark:via-indigo-950',
        'violet' => 'via-violet-50 dark:via-violet-950',
        'purple' => 'via-purple-50 dark:via-purple-950',
        'pure' => 'via-white dark:via-black',
        default => '',
    })
    ->class(match($to) {
        'emerald' => 'to-emerald-50 dark:to-emerald-950',
        'teal' => 'to-teal-50 dark:to-teal-950',
        'cyan' => 'to-cyan-50 dark:to-cyan-950',
        'sky' => 'to-sky-50 dark:to-sky-950',
        'blue' => 'to-blue-50 dark:to-blue-950',
        'indigo' => 'to-indigo-50 dark:to-indigo-950',
        'violet' => 'to-violet-50 dark:to-violet-950',
        'purple' => 'to-purple-50 dark:to-purple-950',
        'pure' => 'to-white dark:to-black',
        default => match($from) {
            'emerald' => 'to-blue-50 dark:to-blue-950',
            'teal' => 'to-indigo-50 dark:to-indigo-950',
            'cyan' => 'to-violet-50 dark:to-violet-950',
            'sky' => 'to-purple-50 dark:to-purple-950',
            'blue' => 'to-emerald-50 dark:to-emerald-950',
            'indigo' => 'to-teal-50 dark:to-teal-950',
            'violet' => 'to-cyan-50 dark:to-cyan-950',
            'purple' => 'to-sky-50 dark:to-sky-950',
            'pure' => 'to-black dark:to-white',
            default => '',
        },
    });
}
@endphp
<section id="{{ $id }}" {{ $attributes->class('py-24 px-6 min-h-screen flex flex-col justify-center items-center text-center') }}>
    <h2 @class(['text-4xl font-bold', 'mb-8' => isset($tagline), 'mb-6' => !isset($tagline)])>@lang($title)</h2>
    @isset($tagline)
    <p class="text-lg max-w-3xl mx-auto text-gray-700 dark:text-gray-300 mb-12">
        @lang($tagline)
    </p>
    @endisset
    {!! $slot !!}
</section>
