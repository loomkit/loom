<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\TextInput;

class LastNameField extends NameField
{
    public static function make(?string $name = null): TextInput
    {
        $name ??= config()->string('loom.components.last_name.name', 'last_name');

        return parent::make($name)
            ->nullable(config()->boolean('loom.components.last_name.optional', true))
            ->label(__('loom::components.last_name'));
    }
}
