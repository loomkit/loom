<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\ImageColumn;

class PhotoColumn extends AvatarColumn
{
    public static function make(?string $name = null): ImageColumn
    {
        $name ??= loom()->config('components.photo.name', 'photo_path');

        return parent::make($name)
            ->label(loom()->trans('components.photo'));
    }
}
