<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class DescriptionColumn extends Column
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= loom()->config('components.description.name', 'description');

        return TextColumn::make($name)
            ->sortable()
            ->searchable()
            ->wrap()
            ->words(12)
            ->limit(48)
            ->lineClamp(1)
            ->label(loom()->trans('components.description'));
    }
}
