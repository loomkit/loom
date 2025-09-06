<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\Field as FormField;

abstract class Field
{
    abstract public static function make(?string $name = null): FormField;
}
