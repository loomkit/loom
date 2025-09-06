<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\Column as TableColumn;
use Loom\Components\Component;

abstract class Column extends Component
{
    abstract public static function make(?string $name = null): TableColumn;
}
