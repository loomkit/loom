<?php

declare(strict_types=1);

namespace Loom\Commands\Aliases;

use Loom\Commands\MakeFieldCommand as Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'loom:field')]
class MakeFieldCommand extends Command
{
    protected $hidden = true;

    protected $signature = 'loom:field {name} {component} {label?} {--f|force}';
}
