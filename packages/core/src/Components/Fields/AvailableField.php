<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\Toggle;

class AvailableField extends Field
{
    public static function make(?string $name = null): Toggle
    {
        $name ??= 'available';

        return Toggle::make($name)
            ->required()
            ->inline(false)
            ->default(true)
            ->label(__('loom::components.available'));
    }
}
