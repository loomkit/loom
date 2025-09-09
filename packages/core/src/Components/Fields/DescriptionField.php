<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\Textarea;

class DescriptionField extends Field
{
    public static function make(?string $name = null): Textarea
    {
        $name ??= loom()->config('components.description.name', 'description');

        return Textarea::make($name)
            ->autosize()
            ->minLength(config()->integer('loom.components.description.min_length', 2))
            ->maxLength(config()->integer('loom.components.description.max_length', 1024))
            ->columnSpanFull()
            ->label(loom()->trans('components.description'));
    }
}
