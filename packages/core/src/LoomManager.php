<?php

declare(strict_types=1);

namespace Loom;

use Illuminate\Support\Str;
use Throwable;

/**
 * @api
 *
 * @phpstan-type TPanelOptions array{id?: string, path: string, ...}
 * @phpstan-type TPanelsConfig array<string, TPanelOptions>
 * @phpstan-type TComponentOptions array<string, string>
 * @phpstan-type TComponentsConfig array<string, TComponentOptions>
 * @phpstan-type TConfig array{panels: TPanelsConfig, components: TComponentsConfig}
 */
final class LoomManager
{
    public const string VERSION = '0.0.0';

    public const string NAME = 'Loom';

    public const string ICON = '🧵';

    public const string COLOR = '#3b82f6';

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

    /**
     * @var array<string, string>
     */
    protected array $assets = [];

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

    public function slug(): string
    {
        return Str::slug($this->name());
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

    public function plugin(): LoomPlugin
    {
        /** @var LoomPlugin */
        $plugin = filament(app(LoomPlugin::class)->getId());

        return $plugin;
    }

    /**
     * @param  string|TPanelOptions  $options
     */
    public function panel(string|array $options): LoomPanel
    {
        if (is_string($options)) {
            $options = ['id' => $options, 'path' => $options];
        }

        $defaultOptions = loom()->config('defaults.panel', ['id' => 'app']);

        return LoomPanel::make([...$defaultOptions, ...$options])
            ->default($options['id'] === $defaultOptions['id'])
            ->pages([
                Pages\Dashboard::class,
            ]);
    }

    /**
     * @template TValue of mixed
     *
     * @param  TValue  $default
     * @return ($key is null ? TConfig : ($key is string ? ($default is null ? mixed : TValue) : array))
     */
    public function config(string|array|null $key = null, mixed $default = null): mixed
    {
        if (is_null($key)) {
            return config('loom');
        }

        if (is_array($key)) {
            $options = [];
            foreach ($key as $k => $v) {
                $options["loom.{$k}"] = $v;
            }
            config($options);

            return $key;
        }

        return config("loom.{$key}", $default);
    }

    /**
     * Translate the given message.
     */
    public function trans(string $key, array $replace = [], ?string $locale = null): string|array
    {
        return trans("loom::{$key}", $replace, $locale);
    }

    public function basePath(string $path = ''): string
    {
        return dirname(__DIR__).DIRECTORY_SEPARATOR.$this->normalizePath($path);
    }

    public function resourcePath(string $path = ''): string
    {
        return $this->basePath("resources/{$this->normalizePath($path)}");
    }

    public function distPath(string $path = ''): string
    {
        return $this->resourcePath("dist/{$this->normalizePath($path)}");
    }

    public function asset(string $path): string
    {
        $path = $this->normalizePath($path);

        if (! isset($this->assets[$path])) {
            $this->assets[$path] = file_exists(public_path($this->vendorPath($path)))
            ? asset(str_replace('\\', '/', $this->vendorPath($path)))
            : $this->base64file($this->distPath($path));
        }

        return $this->assets[$path];
    }

    public function logoPath(): string
    {
        return $this->asset('logo.svg');
    }

    public function faviconPath(): string
    {
        return $this->asset('favicon.svg');
    }

    protected function vendorPath(string $path = ''): string
    {
        return "vendor/{$this->slug()}/{$this->normalizePath($path)}";
    }

    protected function normalizePath(string $path): string
    {
        return trim(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $path), DIRECTORY_SEPARATOR);
    }

    protected function base64file(string $path): string
    {
        if (is_file($path) && ($data = file_get_contents($path))) {
            return $this->base64data($data, Str::afterLast($path, '.'));
        }

        return '';
    }

    protected function base64data(string $data, string $ext): string
    {
        return "data:{$this->mimeType($ext)};base64,".base64_encode($data);
    }

    protected function mimeType(string $ext): string
    {
        return match ($ext) {
            // Fonts
            'woff2' => 'font/woff2',
            'woff' => 'font/woff',
            'ttf' => 'font/ttf',
            'otf' => 'font/otf',
            'eot' => 'application/vnd.ms-fontobject',
            // Images
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'avif' => 'image/avif',
            'svg' => 'image/svg+xml',
            'ico' => 'image/x-icon',
            // Audios
            'mp3' => 'audio/mpeg',
            'ogg' => 'audio/ogg',
            'wav' => 'audio/wav',
            // Videos
            'mp4' => 'video/mp4',
            'webm' => 'video/webm',
            'ogv' => 'video/ogg',
            // Documents
            'pdf' => 'application/pdf',
            default => '',
        };
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
