<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Schemas\Components\Group;
use Illuminate\Support\Str;

class NameAndSlugGroup
{
    public static function make(?string $name = null, ?string $slug = null): Group
    {
        $name ??= 'name';
        $slug ??= 'slug';

        return Group::make([
            NameField::make($name)
                ->reactive()
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set($slug, Str::slug($state))),
            SlugField::make($slug),
        ])
            ->columnSpanFull()
            ->columns(2);
    }
}
