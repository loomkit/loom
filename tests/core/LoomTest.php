<?php

use Loom\Loom;

it('can get the version from the manager', function () {
    expect(Loom::version())->not->toBeEmpty();
    expect(Loom::version())->toBeString();
});

it('can get the logo', function () {
    expect(Loom::logo())->not->toBeEmpty();
    expect(Loom::logo())->toBeString();
});
