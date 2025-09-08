<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\TextInput;

class UsernameField extends SlugField
{
    public static function make(?string $name = null): TextInput
    {
        $name ??= config()->string('loom.components.username.name', 'username');

        return parent::make($name)
            ->minLength(config()->integer('loom.components.username.min_length', 4))
            ->maxLength(config()->integer('loom.components.username.max_length', 16))
            ->label(__('loom::components.username'));
    }
}
