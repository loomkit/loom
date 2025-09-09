<?php

declare(strict_types=1);

namespace Loom\Pages;

use BackedEnum;
use Filament\Pages\Dashboard as Page;
use Filament\Support\Icons\Heroicon;

class Dashboard extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBarSquare;
}
