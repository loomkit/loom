<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\ToggleColumn;

class VisibleColumn extends Column
{
    public static function make(?string $name = null): ToggleColumn
    {
        $name ??= loom()->config('components.visible.name', 'visible');

        return ToggleColumn::make($name)
            ->label(loom()->trans('components.visible'));
    }
}
