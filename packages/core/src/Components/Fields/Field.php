<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\Field as FormField;
use Loom\Components\Component;

abstract class Field extends Component
{
    abstract public static function make(?string $name = null): FormField;
}
