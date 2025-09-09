<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\TextInput;

class FirstNameField extends NameField
{
    public static function make(?string $name = null): TextInput
    {
        $name ??= loom()->config('components.first_name.name', 'first_name');

        return parent::make($name)
            ->label(loom()->trans('components.first_name'));
    }
}
