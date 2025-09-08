<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\FileUpload;

class FileField extends Field
{
    public static function make(?string $name = null): FileUpload
    {
        $name ??= config()->string('loom.components.file.name', 'path');

        return FileUpload::make($name)
            ->disk(config()->string('loom.components.file.disk', 'public'))
            ->maxSize(config()->integer('loom.components.file.max_size', 2048))
            ->label(__('loom::components.file'));
    }
}
