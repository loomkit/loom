<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\IconColumn as FilamentIconColumn;

class IconColumn extends Column
{
    public static function make(?string $name = null): FilamentIconColumn
    {
        $name ??= config()->string('loom.components.icon.name', 'icon');

        return FilamentIconColumn::make($name)
            ->icon(fn (string $state): string => str_starts_with($state, 'o-')
                ? "heroicon-{$state}"
                : "heroicon-s-{$state}"
            )
            ->searchable()
            ->label(__('loom::components.icon'));
    }
}
