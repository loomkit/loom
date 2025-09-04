<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class DetailedDescriptionColumn extends DescriptionColumn
{
    public static function make(?string $name = null): TextColumn
    {
        return parent::make($name)
            ->label(__('loom::components.detailed_description'));
    }
}
