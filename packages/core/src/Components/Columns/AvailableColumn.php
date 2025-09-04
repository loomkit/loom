<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\IconColumn;

class AvailableColumn
{
    public static function make(?string $name = null): IconColumn
    {
        $name ??= 'available';

        return IconColumn::make($name)
            ->boolean()
            ->label(__('loom::components.available'));
    }
}
