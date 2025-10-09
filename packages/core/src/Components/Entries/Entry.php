<?php

declare(strict_types=1);

namespace Loom\Components\Entries;

use Filament\Infolists\Components\Entry as InfolistEntry;
use Loom\Components\Component;

abstract class Entry extends Component
{
    abstract public static function make(?string $name = null): InfolistEntry;
}
