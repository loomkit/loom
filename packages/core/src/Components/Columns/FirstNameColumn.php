<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class FirstNameColumn extends NameColumn
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= config()->string('loom.components.first_name.name', 'first_name');

        return parent::make($name)
            ->label(__('loom::components.first_name'));
    }
}
