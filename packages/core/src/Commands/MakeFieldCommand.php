<?php

declare(strict_types=1);

namespace Loom\Commands;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;

#[AsCommand(name: 'make:loom-field')]
class MakeFieldCommand extends MakeCommand
{
    protected $signature = 'make:loom-field {name} {component} {label?} {--f|force}';

    protected $description = 'Create a new field';

    protected $type = 'field';

    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/field.stub');
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
            ['name', InputArgument::REQUIRED, 'The name of the '.strtolower($this->type)],
            ['component', InputArgument::REQUIRED, 'The form component of the '.strtolower($this->type)],
            ['label', InputArgument::OPTIONAL, 'The label of the '.strtolower($this->type)],
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
