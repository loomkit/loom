<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\SelectColumn;

class GenderColumn extends Column
{
    public static function make(?string $name = null): SelectColumn
    {
        $name ??= loom()->config('components.gender.name', 'gender');
        /** @var array<string, string> */
        $options = loom()->config(
            'components.gender.options',
            [
                'male' => loom()->trans('components.male'),
                'female' => loom()->trans('components.female'),
            ]
        );

        return SelectColumn::make($name)
            ->options($options)
            ->sortable()
            ->searchable()
            ->label(loom()->trans('components.gender'));
    }
}
