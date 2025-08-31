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

    public const string LOGO = <<<TXT
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

    public function getVersion(): string
    {
        if (! isset($this->version)) {
            $this->version = $this->resolveVersion();
        }

        return $this->version;
    }

    public function getLogo(string $color = 'blue', bool $filled = true): string
    {
        return PHP_EOL."<fg=$color>".($filled ? self::FILLED_LOGO : self::LOGO).'</>'.PHP_EOL;
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

                if ($package['name'] === 'loomkit/loom') {
                    return $package['version'];
                }
            }

            return self::VERSION;
        } catch (Throwable $e) {
            return self::VERSION;
        }
    }
}
