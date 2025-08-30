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

    protected ?string $version = null;

    public function getVersion(): string
    {
        if (! isset($this->version)) {
            $this->version = $this->resolveVersion();
        }

        return $this->version;
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
