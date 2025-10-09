<?php

declare(strict_types=1);

namespace Loom\Commands\Aliases;

use Loom\Commands\MakeEntryCommand as Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'loom:entry')]
class MakeFieldCommand extends Command
{
    protected $hidden = true;

    protected $signature = 'loom:entry {name} {component} {label?} {--base=} {--f|force}';
}
