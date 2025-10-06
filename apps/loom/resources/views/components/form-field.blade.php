@props([
    'id' => null,
    'type' => 'text',
    'name',
    'label',
    'placeholder' => '',
    'required' => false,
])
<div {{ $attributes->class('flex flex-col text-left') }}>
    <label for="{{ $id ?? $name ?? $type }}" class="mb-2 text-gray-700 dark:text-gray-300">@lang($label ?? Str::studly($name ?? $type))</label>
    @if($type === 'textarea')
    <textarea @required($required) id="{{ $id ?? $name ?? $type }}" placeholder="{{ __($placeholder ?: __('Your :x', ['x' => __(Str::studly($name ?? $type))])) }}" rows="5" class="p-3 rounded-xl bg-gray-200 dark:bg-gray-800 border border-gray-400 dark:border-gray-600 focus:border-blue-500 outline-none"></textarea>
    @else
    <input @required($required) id="{{ $id ?? $name ?? $type }}" type="{{ $type }}" name="{{ $name ?? $type }}" placeholder="{{ __($placeholder ?: __('Your :x', ['x' => __(Str::studly($name ?? $type))])) }}" class="p-3 rounded-xl bg-gray-200 dark:bg-gray-800 border border-gray-400 dark:border-gray-600 focus:border-blue-500 outline-none"/>
    @endif
</div>
