<?php

declare(strict_types=1);

namespace Loom\Components\Fields;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Model;

class PasswordConfirmationField extends Field
{
    public static function make(?string $name = null): TextInput
    {
        $name ??= loom()->config('components.password_confirmation.name', 'password_confirmation');

        return TextInput::make($name)
            ->password()
            ->revealable(config()->boolean(
                'loom.components.password_confirmation.revealable',
                config()->boolean('loom.components.password.revealable', true)
            ))
            ->required(fn (?Model $record) => $record === null)
            ->visible(fn (?Model $record) => $record === null || $record->exists)
            ->dehydrated(config()->boolean('loom.components.password_confirmation.desydrated', false))
            ->label(loom()->trans('components.password_confirmation'));
    }
}
