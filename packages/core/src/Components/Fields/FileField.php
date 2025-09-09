<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\FileUpload;

class FileField extends Field
{
    public static function make(?string $name = null): FileUpload
    {
        $name ??= loom()->config('components.file.name', 'path');

        return FileUpload::make($name)
            ->disk(loom()->config('components.file.disk', 'public'))
            ->maxSize(config()->integer('loom.components.file.max_size', 2048))
            ->label(loom()->trans('components.file'));
    }
}
