<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\ImageColumn as FilamentImageColumn;

class ImageColumn extends Column
{
    public static function make(?string $name = null): FilamentImageColumn
    {
        $name ??= loom()->config('components.image.name', 'image_path');

        return FilamentImageColumn::make($name)
            ->disk(loom()->config('components.image.disk', loom()->config('components.file.disk', 'public')))
            ->label(loom()->trans('components.image'));
    }
}
