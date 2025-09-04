<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\RichEditor;

class DetailedDescriptionField
{
    public static function make(?string $name = null): RichEditor
    {
        $name ??= 'content';

        return RichEditor::make($name)
            ->minLength(8)
            ->columnSpanFull()
            ->label(__('loom::components.detailed_description'));
    }
}
