<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\IconColumn;

class AvailableColumn extends Column
{
    public static function make(?string $name = null): IconColumn
    {
        $name ??= loom()->config('components.available.name', 'available');

        return IconColumn::make($name)
            ->boolean()
            ->label(loom()->trans('components.available'));
    }
}
