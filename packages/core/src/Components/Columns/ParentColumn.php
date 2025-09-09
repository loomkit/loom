<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class ParentColumn extends RelationshipColumn
{
    public static function make(?string $name = null, ?string $titleAttribute = null): TextColumn
    {
        return parent::make(
            $name ?? loom()->config('components.parent.name', 'parent_id'),
            $titleAttribute
        )
            ->label(loom()->trans('components.parent'));
    }
}
