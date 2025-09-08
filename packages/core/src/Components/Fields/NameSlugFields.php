<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Illuminate\Support\Str;

/**
 * @extends Fields<string, \Filament\Forms\Components\TextInput>
 *
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
        $name ??= config()->string('loom.components.name.name', 'name');
        $slug ??= config()->string('loom.components.slug.name', 'slug');

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
