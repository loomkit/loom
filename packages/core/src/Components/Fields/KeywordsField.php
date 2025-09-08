<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\TagsInput;

class KeywordsField extends Field
{
    public static function make(?string $name = null): TagsInput
    {
        $name ??= config()->string('loom.components.keywords.name', 'keywords');

        return TagsInput::make($name)
            ->separator(config()->string('loom.components.keywords.separator', ','))
            ->splitKeys(config()->array('loom.components.keywords.split_keys', ['Tab', 'Entrer', ',', ';', '.']))
            ->columnSpanFull()
            ->label(__('loom::components.keywords'));
    }
}
