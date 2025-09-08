<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\FileUpload;

class AvatarField extends ImageField
{
    public static function make(?string $name = null): FileUpload
    {
        $name ??= config('loom.components.avatar.name', 'avatar_path');

        return parent::make($name)
            ->avatar()
            ->alignCenter()
            ->directory(config('loom.components.avatar.directory', 'images/avatars'))
            ->label(__('loom.components.avatar'));
    }
}
