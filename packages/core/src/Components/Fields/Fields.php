<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use ArrayAccess;
use ArrayIterator;
use Closure;
use Countable;
use Filament\Forms\Components\Field as FormField;
use Filament\Schemas\Components\Component as SchemaComponent;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Flex;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Illuminate\Contracts\Support\Htmlable;
use IteratorAggregate;
use Loom\Components\Component;
use Traversable;

/**
 * @template TKey of string
 * @template TValue of FormField
 *
 * @implements IteratorAggregate<TKey, TValue>
 * @implements ArrayAccess<TKey, TValue>
 */
abstract class Fields extends Component implements ArrayAccess, Countable, IteratorAggregate
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

    public function remove(string $name): static
    {
        unset($this->schema[$name]);

        return $this;
    }

    /**
     * @param  Closure(TValue $field, TKey $name): TValue  $mapper
     */
    public function map(Closure $mapper): static
    {
        foreach ($this as $name => $field) {
            $this[$name] = $mapper($field, $name);
        }

        return $this;
    }

    /**
     * @template T of array<TKey, TValue>
     *
     * @param  Closure(T $fields): T  $pipe
     */
    public function pipe(Closure $pipe): static
    {
        $this->schema = $pipe($this->schema);

        return $this;
    }

    public function group(): Group
    {
        return Group::make($this->schema)
            ->columns($this->count())
            ->columnSpanFull();
    }

    public function fieldset(string|Htmlable|Closure|null $label = null): Fieldset
    {
        return Fieldset::make($label)->schema($this->schema);
    }

    /**
     * @param  array<string,?int>|int|null  $columns
     */
    public function grid(array|int|null $columns = null): Grid
    {
        return Grid::make($columns ?? $this->count())
            ->schema($this->schema)
            ->columnSpanFull();
    }

    public function flex(): Flex
    {
        return Flex::make($this->schema)
            ->columns($this->count())
            ->columnSpanFull();
    }

    public function section(string|Htmlable|Closure|null $heading = null): Section
    {
        return Section::make($heading)
            ->schema($this->schema)
            ->columns($this->count())
            ->columnSpanFull();
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->schema);
    }

    public function count(): int
    {
        return count($this->schema);
    }

    public function __get(string $name): ?FormField
    {
        return $this->get($name);
    }

    public function __set(string $name, FormField $field): void
    {
        $this->set($name, $field);
    }

    public function __isset(string $name): bool
    {
        return $this->has($name);
    }

    public function __unset(string $name): void
    {
        $this->remove($name);
    }

    /**
     * @param  array{}|array{0: FormField}  $fields
     */
    public function __call(string $name, array $fields): ?FormField
    {
        if (isset($fields[0])) {
            $this->set($name, $fields[0]);
        }

        return $this->get($name);
    }

    public function __invoke(string $layout = 'group'): SchemaComponent
    {
        return match (strtolower($layout)) {
            'group' => $this->group(),
            'fieldset' => $this->fieldset(),
            'grid' => $this->grid(),
            'flex' => $this->flex(),
            'flex' => $this->section(),
            default => $this->group()
        };
    }

    /**
     * @param  TKey  $offset
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }

    /**
     * @param  TKey  $offset
     */
    public function offsetGet(mixed $offset): ?FormField
    {
        return $this->get($offset);
    }

    /**
     * @param  TKey  $offset
     * @param  TValue  $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->set($offset, $value);
    }

    /**
     * @param  TKey  $offset
     */
    public function offsetUnset(mixed $offset): void
    {
        $this->remove($offset);
    }
}
