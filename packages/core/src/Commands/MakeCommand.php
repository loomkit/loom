<?php

declare(strict_types=1);

namespace Loom\Commands;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;

abstract class MakeCommand extends GeneratorCommand
{
    use CreatesMatchingTest;

    /**
     * Resolve the fully-qualified path to the stub.
     */
    protected function resolveStubPath(string $stub): string
    {
        $stub = trim($stub, '/');

        return file_exists($customPath = $this->laravel->basePath($stub))
            ? $customPath
            : dirname(__DIR__, 2).DIRECTORY_SEPARATOR.$stub;
    }

    protected function replaceArgument(string &$stub, string $name, string $default = 'null'): static
    {
        $subject = $name === 'name'
        ? str($this->getNameInput())->beforeLast(ucfirst($this->type))->snake()
        : str($this->argument($name))->trim();

        if ($subject->isEmpty() && $name === 'label') {
            $subject = str($this->getNameInput())
                ->beforeLast(ucfirst($this->type))
                ->snake(' ')
                ->title();
        }

        if ($subject->isEmpty()) {
            $subject = $default;
        } elseif (in_array($name, ['name', 'label'])) {
            $subject = $subject->replace(['\\', '\''], ['\\\\', '\\\''])->wrap('\'');
        }

        $stub = str_replace(['Dummy'.ucfirst($name), '{{ '.$name.' }}', '{{'.$name.'}}'], (string) $subject, $stub);

        return $this;
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    #[\Override]
    protected function getNameInput()
    {
        $name = str(parent::getNameInput())->studly();
        $type = str($this->type)->studly()->toString();

        if (! $name->endsWith($type)) {
            $name = $name->append($type);
        }

        return $name->toString();
    }
}
