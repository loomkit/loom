<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\RichEditor;

class DetailedDescriptionField extends Field
{
    public static function make(?string $name = null): RichEditor
    {
        $name ??= config()->string('loom.components.detailed_description.name', 'description');

        return RichEditor::make($name)
            ->minLength(config()->integer('loom.components.detailed_description.min_length', 8))
            ->columnSpanFull()
            ->label(__('loom::components.detailed_description'));
    }
}
