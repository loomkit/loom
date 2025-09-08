<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Illuminate\Support\Str;

/**
 * @property ?NameField $name
 * @property ?SlugField $slug
 *
 * @method ?SlugField slug(?SlugField $field)
 * @method ?NameField name(?NameField $field)
 */
class NameSlugFields extends Fields
{
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

        return $self;
    }
}
