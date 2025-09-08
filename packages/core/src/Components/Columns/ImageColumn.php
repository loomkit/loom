<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\ImageColumn as FilamentImageColumn;

class ImageColumn extends Column
{
    public static function make(?string $name = null): FilamentImageColumn
    {
        $name ??= config('loom.components.image.name', 'image_path');

        return FilamentImageColumn::make($name)
            ->disk(config('loom.components.image.disk', config('loom.components.file.disk', 'public')))
            ->label(__('loom::components.image'));
    }
}
