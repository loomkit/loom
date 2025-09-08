<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class NameColumn extends Column
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= config()->string('loom.components.name.name', 'name');

        return TextColumn::make($name)
            ->sortable()
            ->searchable()
            ->label(__('loom::components.name'));
    }
}
