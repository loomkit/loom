<?php

declare(strict_types=1);

namespace Loom\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;
use Illuminate\Translation\PotentiallyTranslatedString;

class IconRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string):PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $icon_name = (string) $value;
        $icon_name = Str::squish($icon_name);
        $icon_name = Str::kebab($icon_name);
        $icon_size = config('sikessem.ui.components.icon.attributes.size', 24);
        $icon_type = config('sikessem.ui.components.icon.attributes.type', 'solid');
        $icon_path = sikessem_ui_path("resources/icons/$icon_size/$icon_type/$icon_name.svg");
        if (! is_file($icon_path)) {
            $fail(__('loom::rules.icon', [
                'name' => $icon_name,
                'type' => $icon_type,
                'path' => $icon_path,
            ]));
        }
    }
}
