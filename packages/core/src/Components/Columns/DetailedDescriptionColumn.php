<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class DetailedDescriptionColumn extends DescriptionColumn
{
    public static function make(?string $name = null): TextColumn
    {
        $name ??= config()->string('loom.components.detailed_description.name', 'description');

        return parent::make($name)
            ->label(__('loom::components.detailed_description'));
    }
}
