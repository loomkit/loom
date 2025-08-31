<?php

declare(strict_types=1);

namespace Loom;

use Loom\Commands\MakeColumnCommand;
use Loom\Commands\MakeFieldCommand;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LoomServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('loom')
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->startWith(function (InstallCommand $command) {
                        $command->info(PHP_EOL.'<fg=blue>'.LoomManager::FILLED_LOGO.'</>'.PHP_EOL);
                    })
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('loomkit/loom');
            });
    }

    public function registeringPackage(): void
    {
        $this->registerServices();
    }

    public function bootingPackage(): void
    {
        $this->registerPublishables();
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        $commands = [
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

    protected function registerServices(): void
    {
        $this->app->singleton(LoomManager::class);
        $this->app->alias(LoomManager::class, 'loom');
    }

    protected function registerPublishables(): void
    {
        $this->publishesToGroups([
            __DIR__.'/../stubs' => base_path('stubs/loom'),
        ], ['loom', 'loom-core', 'loom-stubs', 'loom-core-stubs']);
    }

    /**
     * @param  string[]|null  $groups
     */
    protected function publishesToGroups(array $paths, ?array $groups = null): void
    {
        if (is_null($groups)) {
            $this->publishes($paths);

            return;
        }

        foreach ($groups as $group) {
            $this->publishes($paths, $group);
        }
    }
}
