<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class TagsColumn extends Column
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= loom()->config('components.tags.name', 'tags');

        return TextColumn::make($name)
            ->badge()
            ->separator(loom()->config('components.tags.separator', ','))
            ->sortable()
            ->searchable()
            ->listWithLineBreaks()
            ->wrap()
            ->words(config()->integer('loom.components.tags.words', 6))
            ->limit(config()->integer('loom.components.tags.limit', 96))
            ->lineClamp(config()->integer('loom.components.tags.line_clamp', 2))
            ->label(loom()->trans('components.tags'));
    }
}
