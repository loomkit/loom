<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class ContentColumn
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= 'content';

        return TextColumn::make($name)
            ->sortable()
            ->searchable()
            ->wrap()
            ->limit(64)
            ->label(__('loom::components.content'));
    }
}
