<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Illuminate\Support\Str;
use Loom\Components\Fields;

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
    /**
     * @param  array<string, \Filament\Forms\Components\TextInput>|null  $schema
     * @return parent<string, \Filament\Forms\Components\TextInput>
     */
    public static function make(?array $schema = null): parent
    {
        $name = loom()->config('components.name.name', 'name');
        $slug = loom()->config('components.slug.name', 'slug');

        return parent::make($schema ?? [
            $name => NameField::make($name)
                ->reactive()
                ->live(onBlur: true)
                ->afterStateUpdated(fn (string $state, callable $set) => $set($slug, Str::slug($state))),
            $slug => SlugField::make($slug),
        ]);
    }
}
