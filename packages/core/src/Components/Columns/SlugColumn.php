<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class SlugColumn extends Column
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= config('loom.components.slug.name', 'slug');

        return TextColumn::make($name)
            ->sortable()
            ->searchable()
            ->label(__('loom::components.slug'));
    }
}
