<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\Toggle;

class VisibleField extends Field
{
    public static function make(?string $name = null): Toggle
    {
        $name ??= config('loom.components.visible.name', 'visible');

        return Toggle::make($name)
            ->label(__('loom::components.visible'));
    }
}
