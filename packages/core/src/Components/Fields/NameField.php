<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\TextInput;

class NameField
{
    public static function make(?string $name = null): TextInput
    {
        $name ??= 'name';

        return TextInput::make($name)
            ->required()
            ->minLength(2)
            ->maxLength(255)
            ->label(__('loom::components.name'));
    }
}
