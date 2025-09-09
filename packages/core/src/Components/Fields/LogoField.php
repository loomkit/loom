<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\FileUpload;

class LogoField extends AvatarField
{
    public static function make(?string $name = null): FileUpload
    {
        $name ??= loom()->config('components.logo.name', 'logo_path');

        return parent::make($name)
            ->label(loom()->trans('components.logo'));
    }
}
