<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\TextInput;

class NameField extends Field
{
    public static function make(?string $name = null): TextInput
    {
        $name ??= config()->string('loom.components.name.name', 'name');

        return TextInput::make($name)
            ->required()
            ->minLength(config()->integer('loom.components.name.min_length', 2))
            ->maxLength(config()->integer('loom.components.name.max_length', 255))
            ->label(__('loom::components.name'));
    }
}
