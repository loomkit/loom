<?php

declare(strict_types=1);

namespace Loom\Rules;

use Closure;
use Filament\Support\Icons\Heroicon;
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
        $icon = (string) $value;
        $icon = Str::squish($icon);
        $icon = Str::kebab($icon);
        $icons = array_column(Heroicon::cases(), 'value', 'value');
        if (! in_array($icon, $icons, true)) {
            $fail(loom()->trans('rules.icon', compact('icon')));
        }
    }
}
