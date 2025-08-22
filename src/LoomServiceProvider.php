<?php

declare(strict_types=1);

namespace Loom;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LoomServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('loom')
            ->hasCommands($this->getCommands())
            ->hasConfigFile();
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        $commands = [
            //
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
