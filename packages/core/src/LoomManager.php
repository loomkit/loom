<?php

declare(strict_types=1);

namespace Loom;

use Throwable;

/**
 * @api
 */
final class LoomManager
{
    public const string VERSION = '0.0.0';

    public const string NAME = 'Loom';

    public const string ICON = '🧵';

    public const string COLOR = 'blue';

    public const string SIMPLE_LOGO = <<<TXT
  _
 | |    ___   ___  _ __ ___
 | |   / _ \ / _ \| '_ ` _ \
 | |__| (_) | (_) | | | | | |
 |_____\___/ \___/|_| |_| |_|
TXT;

    public const string FILLED_LOGO = <<<'TXT'
 ██╗       ██████╗   ██████╗  ███╗   ███╗
 ██║      ██╔═══██╗ ██╔═══██╗ ████╗ ████║
 ██║      ██║   ██║ ██║   ██║ ██╔████╔██║
 ██║      ██║   ██║ ██║   ██║ ██║╚██╔╝██║
 ███████╗ ╚██████╔╝ ╚██████╔╝ ██║ ╚═╝ ██║
 ╚══════╝  ╚═════╝   ╚═════╝  ╚═╝     ╚═╝
TXT;

    protected ?string $version = null;

    protected ?string $namespace = null;

    protected string $name = self::NAME;

    protected string $icon = self::ICON;

    protected string $color = self::COLOR;

    protected string $logo = self::FILLED_LOGO;

    public function version(): string
    {
        if (! isset($this->version)) {
            $this->version = $this->resolveVersion();
        }

        return $this->version;
    }

    public function namespace(): string
    {
        if (! isset($this->namespace)) {
            $this->namespace = __NAMESPACE__.'\\';
        }

        return $this->namespace;
    }

    public function name(?string $newName = null): string
    {
        if (isset($newName)) {
            $this->name = $newName;
        }

        return $this->name;
    }

    public function icon(?string $newIcon = null): string
    {
        if (isset($newIcon)) {
            $this->icon = $newIcon;
        }

        return $this->icon;
    }

    public function color(?string $newColor = null): string
    {
        if (isset($newColor)) {
            $this->color = $newColor;
        }

        return $this->color;
    }

    public function niceName(): string
    {
        return $this->name().' '.$this->icon();
    }

    public function useSimpleLogo(): string
    {
        return $this->logo(self::SIMPLE_LOGO);
    }

    public function useFilledLogo(): string
    {
        return $this->logo(self::FILLED_LOGO);
    }

    public function logo(?string $newLogo = null): string
    {
        if (isset($newLogo)) {
            $this->logo = $newLogo;
        }

        return app()->runningInConsole()
            ? PHP_EOL."<fg={$this->color()}>".$this->logo.'</>'.PHP_EOL
            : $this->logo;
    }

    private function resolveVersion(): string
    {
        try {
            $path = base_path('composer.lock');

            if (! file_exists($path)) {
                return self::VERSION;
            }

            $composer = json_decode(file_get_contents($path), true);

            if (! isset($composer['packages']) || ! is_array($composer['packages'])) {
                return self::VERSION;
            }

            foreach ($composer['packages'] as $package) {
                if (! isset($package['name'], $package['version'])) {
                    continue;
                }

                if ($package['name'] === 'loomkit/core') {
                    return $package['version'];
                }
            }

            return self::VERSION;
        } catch (Throwable $e) {
            return self::VERSION;
        }
    }
}
