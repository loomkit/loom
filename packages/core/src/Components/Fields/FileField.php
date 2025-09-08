<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\FileUpload;

class FileField extends Field
{
    public static function make(?string $name = null): FileUpload
    {
        $name ??= 'path';

        return FileUpload::make($name)
            ->disk(config('loom.components.file.disk'))
            ->maxSize(config('loom.components.file.max_size'))
            ->label(__('loom::components.file'));
    }
}
