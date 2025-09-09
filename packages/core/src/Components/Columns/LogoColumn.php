<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\ImageColumn;

class LogoColumn extends AvatarColumn
{
    public static function make(?string $name = null): ImageColumn
    {
        $name ??= loom()->config('components.logo.name', 'logo_path');

        return parent::make($name)
            ->label(loom()->trans('components.logo'));
    }
}
