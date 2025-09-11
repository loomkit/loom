<?php

declare(strict_types=1);

namespace Loom;

use Filament\Contracts\Plugin;
use Filament\Panel;

class LoomPlugin implements Plugin
{
    public function __construct(public readonly LoomManager $loom) {}

    public function getId(): string
    {
        return $this->loom->slug();
    }

    public static function make(): self
    {
        return app(self::class);
    }

    public function register(Panel $panel): void
    {
        // TODO: Register the panel
    }

    public function boot(Panel $panel): void
    {
        // TODO: Boot the panel
    }
}
