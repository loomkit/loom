<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\ImageColumn as FilamentImageColumn;

class CoverColumn extends ImageColumn
{
    public static function make(?string $name = null): FilamentImageColumn
    {
        $name ??= config()->string('loom.components.cover.name', 'cover_path');

        return parent::make($name)
            ->label(__('loom.components.cover'));
    }
}
