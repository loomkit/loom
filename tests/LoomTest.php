<?php

use Loom\Loom;

it('can get the version from the manager', function () {
    expect(Loom::getVersion())->not->toBeEmpty();
    expect(Loom::getVersion())->toBeString();
});
