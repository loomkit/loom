<?php

declare(strict_types=1);

namespace Loom\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(name: 'make:loom-field')]
class MakeFieldCommand extends MakeCommand
{
    protected $signature = 'make:loom-field {name} {component} {label?} {--base=} {--f|force}';

    protected $description = 'Create a new field';

    protected $type = 'field';

    protected function getStub()
    {
        return $this->resolveStubPath('field.stub');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    #[\Override]
    protected function getArguments()
    {
        return [
            ...parent::getArguments(),
            ['component', InputArgument::REQUIRED, 'The Filament form component of the '.$this->type],
            ['label', InputArgument::OPTIONAL, 'The label of the '.$this->type],
        ];
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    #[\Override]
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        $this
            ->replaceArgument($stub, 'base')
            ->replaceArgument($stub, 'component')
            ->replaceArgument($stub, 'name')
            ->replaceArgument($stub, 'label');

        return $stub;
    }

    /**
     * @param  string  $rootNamespace
     */
    #[\Override]
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\\Loom\\Fields';
    }
}
