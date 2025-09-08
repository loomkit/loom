<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\TextInput;

class LastNameField extends NameField
{
    public static function make(?string $name = null): TextInput
    {
        $name ??= config('loom.components.last_name.name', 'last_name');

        return parent::make($name)
            ->optional(config('loom.components.last_name.optional', true))
            ->label(__('loom::components.last_name'));
    }
}
