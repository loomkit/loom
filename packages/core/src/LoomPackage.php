<?php

declare(strict_types=1);

namespace Loom;

use Loom\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;

class LoomPackage extends Package
{
    #[\Override]
    public function hasInstallCommand($callable): static
    {
        $installCommand = new InstallCommand($this);

        $callable($installCommand);

        $this->consoleCommands[] = $installCommand;

        return $this;
    }
}
