<?php

declare(strict_types=1);

test('globals')
    ->expect(['dd', 'dump', 'ray'])
    ->not->toBeUsed();

test('classes')
    ->expect('Loom')
    ->toUseStrictTypes();

test('contracts')
    ->expect('Loom\Contracts')
    ->interfaces()
    ->toOnlyBeUsedIn('Loom', 'Loom\Contracts');

test('concerns')
    ->expect('Loom\Concerns')
    ->traits()
    ->toOnlyBeUsedIn('Loom', 'Loom\Concerns');
