<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class KeywordsColumn extends Column
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= config()->string('loom.components.keywords.name', 'keywords');

        return TextColumn::make($name)
            ->badge()
            ->separator(config()->string('loom.components.keywords.separator', ','))
            ->sortable()
            ->searchable()
            ->listWithLineBreaks()
            ->wrap()
            ->words(config()->integer('loom.components.keywords.words', 6))
            ->limit(config()->integer('loom.components.keywords.limit', 96))
            ->lineClamp(config()->integer('loom.components.keywords.column.line_clamp', 2))
            ->label(__('loom::components.keywords'));
    }
}
