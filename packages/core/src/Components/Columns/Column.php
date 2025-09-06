<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\Column as TableColumn;

abstract class Column
{
    abstract public static function make(?string $name = null): TableColumn;
}
