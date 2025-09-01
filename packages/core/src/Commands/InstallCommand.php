<?php

declare(strict_types=1);

namespace Loom\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Loom\LoomPackage;
use Spatie\LaravelPackageTools\Commands\Concerns\AskToRunMigrations;
use Spatie\LaravelPackageTools\Commands\Concerns\AskToStarRepoOnGitHub;
use Spatie\LaravelPackageTools\Commands\Concerns\PublishesResources;
use Spatie\LaravelPackageTools\Commands\Concerns\SupportsServiceProviderInApp;
use Spatie\LaravelPackageTools\Commands\Concerns\SupportsStartWithEndWith;

class InstallCommand extends Command
{
    use AskToRunMigrations;
    use AskToStarRepoOnGitHub;
    use PublishesResources;
    use SupportsServiceProviderInApp;
    use SupportsStartWithEndWith;

    protected LoomPackage $package;

    public function __construct(LoomPackage $package)
    {
        $this->signature = $package->shortName().':install';

        $this->description = 'Install '.Str::title($package->name);

        $this->package = $package;

        $this->hidden = true;

        parent::__construct();
    }

    public function handle(): int
    {
        $package = Str::title($this->package->name);

        $this->info("📥 Installing {$package}...");

        $this
            ->processStartWith()
            ->processPublishes()
            ->processAskToRunMigrations()
            ->processCopyServiceProviderInApp()
            ->processStarRepo()
            ->processEndWith();

        $this->info("{$package} has been installed! ✅");

        return self::SUCCESS;
    }
}
