<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class KeywordsColumn extends TagsColumn
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= config()->string('loom.components.keywords.name', 'keywords');

        return parent::make($name)
            ->label(__('loom::components.keywords'));
    }
}
