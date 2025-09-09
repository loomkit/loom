<?php

declare(strict_types=1);

namespace Loom;

use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;

abstract class LoomPanelServiceProvider extends ServiceProvider
{
    abstract public function panel(LoomPanel $panel): LoomPanel;

    public function register(): void
    {
        Filament::registerPanel(
            fn (): LoomPanel => $this->panel(LoomPanel::make()),
        );
    }
}
