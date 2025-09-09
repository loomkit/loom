<?php

use Loom\Loom;
use Loom\LoomManager;

it('can get the version from the manager', function () {
    expect(Loom::version())->not->toBeEmpty();
    expect(Loom::version())->toBeString();
});

it('can get the logo', function () {
    expect(Loom::logo())->not->toBeEmpty();
    expect(Loom::logo())->toBeString();
});

test('loom() should be an instance of LoomManager', function () {
    expect(loom())->toBeInstanceOf(LoomManager::class);
});
