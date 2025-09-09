<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\TagsInput;

class TagsField extends Field
{
    public static function make(?string $name = null): TagsInput
    {
        $name ??= loom()->config('components.tags.name', 'tags');

        return TagsInput::make($name)
            ->separator(loom()->config('components.tags.separator', ','))
            ->splitKeys(config()->array('loom.components.tags.split_keys', ['Tab', 'Entrer', ',', ';', '.']))
            ->columnSpanFull()
            ->label(loom()->trans('components.tags'));
    }
}
