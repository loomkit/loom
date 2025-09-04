<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\ToggleColumn;

class VisibleColumn
{
    public static function make(?string $name = null): ToggleColumn
    {
        $name ??= 'visible';

        return ToggleColumn::make($name)
            ->label(__('loom::components.visible'));
    }
}
