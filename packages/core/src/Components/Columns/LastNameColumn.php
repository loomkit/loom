<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class LastNameColumn extends NameColumn
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= loom()->config('components.last_name.name', 'last_name');

        return parent::make($name)
            ->label(loom()->trans('components.last_name'));
    }
}
