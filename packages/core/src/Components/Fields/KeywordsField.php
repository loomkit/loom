<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\TagsInput;

class KeywordsField extends TagsField
{
    public static function make(?string $name = null): TagsInput
    {
        $name ??= loom()->config('components.keywords.name', 'keywords');

        return parent::make($name)
            ->label(loom()->trans('components.keywords'));
    }
}
