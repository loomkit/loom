<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Closure;
use Filament\Forms\Components\Field as FormField;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Illuminate\Contracts\Support\Htmlable;
use Loom\Components\Component;

abstract class Fields extends Component
{
    /**
     * @param  array<string, FormField>  $schema
     */
    public function __construct(protected array $schema = []) {}

    abstract public static function make(): self;

    public function set(string $name, FormField $field): static
    {
        $this->schema[$name] = $field;

        return $this;
    }

    public function has(string $name): bool
    {
        return isset($this->schema[$name]);
    }

    public function get(string $name): ?FormField
    {
        return $this->schema[$name] ?? null;
    }

    public function group(): Group
    {
        return Group::make($this->schema);
    }

    public function fieldset(string|Htmlable|Closure|null $label = null): Fieldset
    {
        return Fieldset::make($label)->schema($this->schema);
    }

    /**
     * @param  array<string,?int>|int|null  $columns
     */
    public function grid(array|int|null $columns = 2): Grid
    {
        return Grid::make($columns)->schema($this->schema);
    }

    public function flex(): Flex
    {
        return Flex::make($this->schema);
    }
}
