<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\RichEditor;

class DetailedDescriptionField extends Field
{
    public static function make(?string $name = null): RichEditor
    {
        $name ??= loom()->config('components.detailed_description.name', 'description');

        return RichEditor::make($name)
            ->minLength(config()->integer('loom.components.detailed_description.min_length', 8))
            ->columnSpanFull()
            ->fileAttachmentsDisk(loom()->config('components.file.disk', 'public'))
            ->fileAttachmentsDirectory(loom()->config('components.file.directory', 'uploads'))
            ->fileAttachmentsVisibility(loom()->config('components.file', 'public'))
            ->label(loom()->trans('components.detailed_description'));
    }
}
