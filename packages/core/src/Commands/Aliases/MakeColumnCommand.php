<?php

declare(strict_types=1);

namespace Loom\Commands\Aliases;

use Loom\Commands\MakeColumnCommand as Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'loom:column')]
class MakeColumnCommand extends Command
{
    protected $hidden = true;
}
