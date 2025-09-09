<?php

declare(strict_types=1);

namespace Loom;

use Filament\Facades\Filament;
use Loom\Commands\InstallCommand;
use Loom\Commands\MakeColumnCommand;
use Loom\Commands\MakeFieldCommand;
use Spatie\LaravelPackageTools\Package;

class LoomServiceProvider extends LoomPackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('loom')
            ->hasConfigFile()
            ->hasTranslations()
            ->hasAssets()
            ->hasCommands($this->getCommands())
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->startWith(function (InstallCommand $command) {
                        $command->info(Loom::logo());
                    })
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('loomkit/loom');
            });
    }

    public function registeringPackage(): void
    {
        $this->registerServices();
    }

    public function packageRegistered(): void
    {
        $this->registerPanels();
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
        $this->app->scoped(LoomPlugin::class);
        $this->app->alias(LoomManager::class, 'loom');
    }

    protected function registerPublishables(): void
    {
        $this->publishesToGroups([
            __DIR__.'/../stubs' => base_path('stubs/loom'),
        ], ['loom', 'loom-core', 'loom-stubs', 'loom-core-stubs']);
    }

    protected function registerPanels(): void
    {
        $defaultConfig = loom()->config('defaults.panel', []);
        $panels = loom()->config('panels');

        foreach ($panels as $id => $config) {
            $config['id'] ??= $id;
            $panel = LoomPanel::make([...$defaultConfig, ...$config])
                ->default(isset($defaultConfig['id']) && $config['id'] === $defaultConfig['id'])
                ->pages([
                    Pages\Dashboard::class,
                ]);
            Filament::registerPanel($panel);
        }
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
