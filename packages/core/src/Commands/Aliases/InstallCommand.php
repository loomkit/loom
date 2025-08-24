<?php

declare(strict_types=1);

namespace Loom\Commands\Aliases;

use Loom\Commands\InstallCommand as Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'sikessem:field')]
class InstallCommand extends Command
{
    protected $hidden = true;

    protected $signature = 'loom-install {--f|force}';
}
