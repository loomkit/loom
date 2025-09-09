<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\FileUpload;

class ImageField extends FileField
{
    public static function make(?string $name = null): FileUpload
    {
        $name ??= loom()->config('components.image.name', 'image_path');

        return parent::make($name)
            ->image()
            ->disk(config()->string('loom.components.image.disk', loom()->config('components.file.disk', 'public')))
            ->directory(loom()->config('components.image.directory', 'images'))
            ->imageEditor()
            ->imageResizeMode(loom()->config('components.image.resize_mode'))
            ->imageCropAspectRatio(loom()->config('components.image.crop_aspect_ratio'))
            ->columnSpanFull()
            ->label(loom()->trans('components.image'));
    }
}
