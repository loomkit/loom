<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Closure;
use Filament\Forms\Components\Select;

class ParentField extends RelatedToField
{
    public static function make(
        ?string $name = null,
        string|Closure|null $titleAttribute = null,
        ?Closure $modifyQueryUsing = null,
        bool $ignoreRecord = false
    ): Select {
        return parent::make(
            $name ?? config()->string('loom.components.parent.name', 'parent_id'),
            $titleAttribute ?? config()->string('loom.components.parent.title_attribute', 'name'),
            $modifyQueryUsing,
            $ignoreRecord
        )
            ->label(__('loom::components.parent'));
    }
}
