<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class LastNameColumn extends NameColumn
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= config()->string('loom.components.last_name.name', 'last_name');

        return parent::make($name)
            ->label(__('loom::components.last_name'));
    }
}
