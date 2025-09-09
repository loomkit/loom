<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;

class PasswordField extends Field
{
    public static function make(?string $name = null): TextInput
    {
        $name ??= loom()->config('components.password.name', 'password');

        return TextInput::make($name)
            ->password()
            ->revealable(config()->boolean('loom.components.password.revealable', true))
            ->confirmed(config()->boolean('loom.components.password.confirmed', true))
            ->visible(fn (?Model $record) => $record === null || $record->exists)
            ->dehydrated(fn ($state) => ! empty($state))
            ->dehydrateStateUsing(fn ($state) => empty($state) ? null : bcrypt($state))
            ->label(loom()->trans('components.password'));
    }
}
