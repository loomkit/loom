<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\TextInput;

class SlugField
{
    public static function make(?string $name = null): TextInput
    {
        $name ??= 'slug';

        return TextInput::make($name)
            ->required()
            ->unique(ignoreRecord: true)
            ->alphaDash()
            ->minLength(1)
            ->maxLength(255)
            ->label(__('loom::components.slug'));
    }
}
