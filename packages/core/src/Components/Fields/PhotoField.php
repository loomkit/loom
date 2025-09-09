<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\FileUpload;

class PhotoField extends AvatarField
{
    public static function make(?string $name = null): FileUpload
    {
        $name ??= loom()->config('components.photo.name', 'photo_path');

        return parent::make($name)
            ->label(__('loom.components.photo'));
    }
}
