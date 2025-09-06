<?php

declare(strict_types=1);

namespace Loom\Components;

use Filament\Support\Components\ViewComponent as FilamentComponent;
use Illuminate\View\Component as BladeComponent;
use Livewire\Component as LivewireComponent;

abstract class Component
{
    abstract public static function make(): FilamentComponent|LivewireComponent|BladeComponent|Component;
}
