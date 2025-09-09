<?php

declare(strict_types=1);

namespace Loom\Components\Columns;

use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;

class RelationshipColumn extends NameColumn
{
    public static function make(?string $name = null, ?string $titleAttribute = null): TextColumn
    {
        $name ??= Str::beforeLast(Str::afterLast(static::class, '\\'), 'Column');
        $related = Str::snake($name);
        if (Str::endsWith($related, '_id')) {
            $related = Str::singular(Str::beforeLast($related, '_id'));
        }
        if (Str::endsWith($related, '_ids')) {
            $related = Str::plural(Str::beforeLast($related, '_ids'));
        }
        $label = "loom::components.{$related}";
        if (__($label) === $label) {
            $label = Str::title($related);
        }
        $titleAttribute ??= config()->string("loom.components.{$related}.title_attribute", 'name');
        $related = Str::camel($related);

        return parent::make("{$related}.{$titleAttribute}")
            ->label(loom()->trans('components.parent'));
    }
}
