<?php

declare(strict_types=1);

namespace App\Loom\Fields;

use App\Rules\IconRule;
use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;

class IconField
{
    public static function make(?string $name = null): Select
    {
        $name ??= 'icon';

        return Select::make($name)
            ->options(array_column(Heroicon::cases(), 'value', 'value'))
            ->rule(new IconRule)
            ->searchable()
            ->label(__('Icon'));
    }
}
