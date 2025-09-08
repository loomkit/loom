<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\SelectColumn;

class GenderColumn extends Column
{
    public static function make(?string $name = null): SelectColumn
    {
        $name ??= config()->string('loom.components.gender.name', 'gender');
        /** @var array<string, string> */
        $options = config()->array(
            'loom.components.gender.options',
            [
                'male' => __('loom::components.male'),
                'female' => __('loom::components.female'),
            ]
        );

        return SelectColumn::make($name)
            ->options($options)
            ->sortable()
            ->searchable()
            ->label(__('loom::components.gender'));
    }
}
