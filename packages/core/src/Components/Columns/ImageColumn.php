<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\ImageColumn as FilamentImageColumn;

class ImageColumn extends Column
{
    public static function make(?string $name = null): FilamentImageColumn
    {
        $name ??= config()->string('loom.components.image.name', 'image_path');

        return FilamentImageColumn::make($name)
            ->disk(config()->string('loom.components.image.disk', config()->string('loom.components.file.disk', 'public')))
            ->label(__('loom::components.image'));
    }
}
