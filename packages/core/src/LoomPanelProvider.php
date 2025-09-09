<?php

declare(strict_types=1);

namespace Loom;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider as FilamentPanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Platform;
use Filament\Support\Icons\Heroicon;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

abstract class LoomPanelProvider extends FilamentPanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->favicon(Loom::faviconPath())
            ->brandName(Loom::name())
            ->brandLogo(Loom::logoPath())
            ->brandLogoHeight('3rem')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->spa(hasPrefetching: true)
            ->sidebarCollapsibleOnDesktop()
            ->globalSearch()
            ->globalSearchFieldKeyBindingSuffix()
            ->globalSearchKeyBindings(['command+k', 'ctrl+k', '/'])
            ->globalSearchFieldSuffix(fn () => match (Platform::detect()) {
                Platform::Windows, Platform::Linux => 'CTRL+K',
                Platform::Mac => '⌘K',
                default => '/',
            })
            ->databaseNotifications()
            ->navigationItems([
                NavigationItem::make(fn () => __('loom::panels.navigation.home'))
                    ->url(url('/'))
                    ->openUrlInNewTab()
                    ->sort(-5)
                    ->icon(Heroicon::OutlinedHome),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
