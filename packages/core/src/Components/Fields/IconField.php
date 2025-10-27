<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\Select;
use Filament\Support\Icons\Heroicon;
use Loom\Rules\IconRule;
use Sikessem\UI\Facade as UI;

class IconField extends Field
{
    public static function make(?string $name = null): Select
    {
        $name ??= loom()->config('components.icon.name', 'icon');

        return Select::make($name)
            ->options(function () {
                $icons = array_column(Heroicon::cases(), 'value', 'value');

                foreach ($icons as $name => $icon) {
                    $icon = str_starts_with($icon, 'o-')
                        ? "heroicon-{$icon}"
                        : "heroicon-s-{$icon}";
                    $icons[$name] = UI::render(<<<HTML
                        <span class="inline-flex items-center justify-center gap-1">
                            <x-filament::icon icon='{$icon}'/>
                            {$name}
                        </span>
                    HTML);
                }

                return $icons;
            })
            ->rule(new IconRule)
            ->searchable()
            ->allowHtml()
            ->label(loom()->trans('components.icon'));
    }
}
