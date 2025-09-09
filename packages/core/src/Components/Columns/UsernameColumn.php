<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class UsernameColumn extends SlugColumn
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= loom()->config('components.username.name', 'username');

        return parent::make($name)
            ->label(loom()->trans('components.username'));
    }
}
