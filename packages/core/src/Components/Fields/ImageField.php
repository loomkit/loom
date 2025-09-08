<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\FileUpload;

class ImageField extends FileField
{
    public static function make(?string $name = null): FileUpload
    {
        $name ??= 'image_path';

        return parent::make($name)
            ->image()
            ->directory(config('loom.components.image.directory'))
            ->imageEditor()
            ->imageResizeMode(config('loom.components.image.resize_mode'))
            ->imageCropAspectRatio(config('loom.components.image.crop_aspect_ratio'))
            ->columnSpanFull()
            ->label(__('loom::components.image'));
    }
}
