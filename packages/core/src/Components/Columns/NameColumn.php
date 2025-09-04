<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class NameColumn
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= 'name';

        return TextColumn::make($name)
            ->sortable()
            ->searchable()
            ->label(__('loom::components.name'));
    }
}
