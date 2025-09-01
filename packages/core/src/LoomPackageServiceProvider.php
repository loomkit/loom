<?php

declare(strict_types=1);

namespace Loom;

use Spatie\LaravelPackageTools\PackageServiceProvider;

abstract class LoomPackageServiceProvider extends PackageServiceProvider
{
    #[\Override]
    public function newPackage(): LoomPackage
    {
        return new LoomPackage;
    }
}
