<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Closure;
use Filament\Forms\Components\Select;

class GenderField extends Field
{
    public static function make(
        ?string $name = null,
        string|Closure|null $titleAttribute = null,
        ?Closure $modifyQueryUsing = null,
        bool $ignoreRecord = false
    ): Select {
        $name ??= loom()->config('components.gender.name', 'gender');
        /** @var array<string, string> */
        $options = config()->array(
            'loom.components.gender.options',
            [
                'male' => loom()->trans('components.male'),
                'female' => loom()->trans('components.female'),
            ]
        );

        return Select::make($name)
            ->options($options)
            ->label(loom()->trans('components.gender'));
    }
}
