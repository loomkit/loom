<?php

declare(strict_types=1);

namespace Loom\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'loom:install')]
class InstallCommand extends Command
{
    protected $signature = 'loom:install {--f|force}';

    protected $description = 'Install Loom';
}
