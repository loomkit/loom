<?php

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class SlugColumn
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= 'slug';

        return TextColumn::make($name)
            ->sortable()
            ->searchable()
            ->label(__('loom::components.slug'));
    }
}
