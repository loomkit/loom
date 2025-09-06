<?php

declare(strict_types=1);

namespace Loom\Commands;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Loom\Loom;
use Symfony\Component\Console\Input\InputArgument;

abstract class MakeCommand extends GeneratorCommand
{
    use CreatesMatchingTest;

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
            ['base', InputArgument::REQUIRED, 'The base '.strtolower($this->type).' to extend'],
        ];
    }

    /**
     * Resolve the fully-qualified path to the stub.
     */
    protected function resolveStubPath(string $stub): string
    {
        $stub = trim($stub, '/');

        return file_exists($customPath = $this->laravel->basePath("/stubs/loom/{$stub}"))
            ? $customPath
            : dirname(__DIR__, 2).DIRECTORY_SEPARATOR."/stubs/{$stub}";
    }

    protected function replaceArgument(string &$stub, string $name, string $default = 'null'): static
    {
        $subject = $name === 'name'
        ? Str::snake(Str::beforeLast($this->getNameInput(), ucfirst($this->type)))
        : (
            $name === 'base'
            ? '\\'.$this->getBaseInput()
            : Str::trim($this->argument($name))
        );

        if (empty($subject) && $name === 'label') {
            $subject = Str::title(Str::snake(
                Str::beforeLast(
                    $this->getNameInput(),
                    ucfirst($this->type)
                ),
                ''
            ));
        }

        if (empty($subject)) {
            $subject = $default;
        } elseif (in_array($name, ['name', 'label'])) {
            $subject = Str::wrap(
                Str::replace(
                    ['\\', '\''],
                    ['\\\\', '\\\''],
                    $subject,
                ),
                '\''
            );
        }

        $stub = str_replace(['Dummy'.ucfirst($name), '{{ '.$name.' }}', '{{'.$name.'}}'], $subject, $stub);

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
        $name = Str::studly(parent::getNameInput());
        $type = Str::studly($this->type);

        if (! str_ends_with($name, $type)) {
            $name .= $type;
        }

        return $name;
    }

    public function getBaseInput(): string
    {
        $base = trim((string) $this->option('base'));
        $typeClass = Str::studly($this->type);
        $typeNamespace = Str::plural($typeClass);

        if (! $base) {
            $base = "Loom\\Components\\{$typeNamespace}\\{$typeClass}";
        }

        if (class_exists($base)) {
            return ltrim($base);
        }

        $rootNamespace = $this->rootNamespace();
        $loomNamespace = $this->loomNamespace();

        if (Str::startsWith($base, ['\\', $rootNamespace, $loomNamespace])) {
            $this->warn("Class {$base} does not exists.");

            return ltrim($base, '\\');
        }

        $baseClass = Str::studly($base);
        $rootTypeNamespace = $rootNamespace.$loomNamespace.$typeNamespace.'\\';
        $loomTypeNamespace = $loomNamespace.'Components\\'.$typeNamespace.'\\';

        if (
            class_exists($class = $rootTypeNamespace.$baseClass) ||
            class_exists($class = $loomTypeNamespace.$baseClass) ||
            class_exists($class = $rootTypeNamespace.$baseClass.$typeClass) ||
            class_exists($class = $loomTypeNamespace.$baseClass.$typeClass)
        ) {
            return $class;
        }

        $this->error("Class {$baseClass} does not exist.");

        return $baseClass;
    }

    public function loomNamespace(): string
    {
        return Loom::getNamespace();
    }
}
