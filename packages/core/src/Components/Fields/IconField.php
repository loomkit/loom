<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;
use Loom\Rules\IconRule;

class IconField
{
    public static function make(?string $name = null): Select
    {
        $name ??= 'icon';

        return Select::make($name)
            ->options(array_column(Heroicon::cases(), 'value', 'value'))
            ->rule(new IconRule)
            ->searchable()
            ->label(__('loom::components.icon'));
    }
}
