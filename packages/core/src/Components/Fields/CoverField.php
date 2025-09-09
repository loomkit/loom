<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\FileUpload;

class CoverField extends ImageField
{
    public static function make(?string $name = null): FileUpload
    {
        $name ??= loom()->config('components.cover.name', 'cover_path');

        return parent::make($name)
            ->alignCenter()
            ->directory(loom()->config('components.cover.directory', 'images/covers'))
            ->label(__('loom.components.cover'));
    }
}
