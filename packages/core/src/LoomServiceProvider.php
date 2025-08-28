<?php

declare(strict_types=1);

namespace Loom;

use Loom\Commands\InstallCommand;
use Loom\Commands\MakeColumnCommand;
use Loom\Commands\MakeFieldCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LoomServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('loom')
            ->hasCommands($this->getCommands());
    }

    public function bootingPackage(): void
    {
        $this->publishes([
            __DIR__.'/../stubs' => base_path('stubs/loom'),
        ], 'loom-stubs');
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        $commands = [
            InstallCommand::class,
            MakeColumnCommand::class,
            MakeFieldCommand::class,
        ];

        $aliases = [];

        foreach ($commands as $command) {
            $class = __NAMESPACE__.'\\Commands\\Aliases\\'.class_basename($command);

            if (! class_exists($class)) {
                continue;
            }

            $aliases[] = $class;
        }

        return [
            ...$commands,
            ...$aliases,
        ];
    }
}
