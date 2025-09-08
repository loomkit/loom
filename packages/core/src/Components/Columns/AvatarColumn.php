<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\ImageColumn as FilamentImageColumn;

class AvatarColumn extends ImageColumn
{
    public static function make(?string $name = null): FilamentImageColumn
    {
        $name ??= config('loom.components.avatar.name', 'avatar_path');

        return parent::make($name)
            ->circular()
            ->label(__('loom.components.avatar'));
    }
}
