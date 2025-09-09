<?php

declare(strict_types=1);

namespace Loom;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Platform;
use Filament\Support\Icons\Heroicon;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Str;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Override;

class LoomPanel extends Panel
{
    protected LoomManager $loom;

    public function __construct()
    {
        $this->loom = loom();
    }

    #[Override]
    public static function make(?array $config = null): static
    {
        ($static = parent::make())
            ->favicon($static->loom->faviconPath())
            ->brandName($static->loom->name())
            ->brandLogo($static->loom->logoPath())
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
                NavigationItem::make(fn () => loom()->trans('panels.navigation.home'))
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

        if ($config) {
            foreach ($config as $key => $value) {
                $method = Str::camel($key);
                if (method_exists($static, $method)) {
                    $static->{$method}($value);
                }
            }
        }

        return $static;
    }
}
