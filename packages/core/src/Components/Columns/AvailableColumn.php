<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\IconColumn;

class AvailableColumn extends Column
{
    public static function make(?string $name = null): IconColumn
    {
        $name ??= config('loom.components.available.name', 'available');

        return IconColumn::make($name)
            ->boolean()
            ->label(__('loom::components.available'));
    }
}
