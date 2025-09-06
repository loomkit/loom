<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\Textarea;

class DescriptionField extends Field
{
    public static function make(?string $name = null): Textarea
    {
        $name ??= 'description';

        return Textarea::make($name)
            ->autosize()
            ->minLength(2)
            ->maxLength(1024)
            ->columnSpanFull()
            ->label(__('loom::components.description'));
    }
}
