<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\TextInput;

class SlugField extends Field
{
    public static function make(?string $name = null): TextInput
    {
        $name ??= config('loom.components.slug.name', 'slug');

        return TextInput::make($name)
            ->required()
            ->unique(ignoreRecord: true)
            ->alphaDash()
            ->minLength(config('loom.components.slug.min_length', 1))
            ->maxLength(config('loom.components.slug.max_length', 255))
            ->label(__('loom::components.slug'));
    }
}
