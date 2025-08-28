<?php

declare(strict_types=1);

arch()
    ->preset()
    ->php();

arch()
    ->preset()
    ->laravel();

arch()
    ->preset()
    ->security();

arch('globals')
    ->expect(['dd', 'dump', 'ray'])
    ->not->toBeUsed();

arch('classes')
    ->expect('Loom')
    ->toUseStrictTypes();

arch('contracts')
    ->expect('Loom\Contracts')
    ->interfaces()
    ->toOnlyBeUsedIn('Loom', 'Loom\Contracts');

arch('concerns')
    ->expect('Loom\Concerns')
    ->traits()
    ->toOnlyBeUsedIn('Loom', 'Loom\Concerns');
