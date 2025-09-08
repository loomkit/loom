<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class UsernameColumn extends SlugColumn
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= config()->string('loom.components.username.name', 'username');

        return parent::make($name)
            ->label(__('loom::components.username'));
    }
}
