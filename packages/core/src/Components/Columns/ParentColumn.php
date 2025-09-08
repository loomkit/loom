<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class ParentColumn extends NameColumn
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= config()->string(
            'loom.components.parent.name',
            'organization'
        ).'.'.config()->string(
            'loom.components.parent.title_attribute',
            'name'
        );

        return parent::make($name)
            ->label(__('loom::components.parent'));
    }
}
