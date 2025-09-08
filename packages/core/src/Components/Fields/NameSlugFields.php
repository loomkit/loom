<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\Field;
use Illuminate\Support\Str;

class NameSlugFields extends Fields
{
    protected string $nameKey = 'name';

    protected string $slugKey = 'slug';

    public static function make(?string $name = null, ?string $slug = null): self
    {
        $name ??= config('loom.components.name.name', 'name');
        $name ??= config('loom.components.slug.name', 'slug');

        $self = new self([
            $name => NameField::make($name)
                ->reactive()
                ->live(onBlur: true)
                ->afterStateUpdated(fn (string $state, callable $set) => $set($slug, Str::slug($state))),
            $slug => SlugField::make($slug),
        ]);

        $self->nameKey = $name;
        $self->slugKey = $slug;

        return $self;
    }

    public function name(): ?Field
    {
        return $this->get($this->nameKey);
    }

    public function slug(): ?Field
    {
        return $this->get($this->slugKey);
    }
}
