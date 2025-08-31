<?php

declare(strict_types=1);

use Illuminate\Filesystem\Filesystem;
use Loom\Commands\Aliases\MakeColumnCommand as MakeColumnCommandAlias;
use Loom\Commands\Aliases\MakeFieldCommand as MakeFieldCommandAlias;
use Loom\Commands\MakeColumnCommand;
use Loom\Commands\MakeFieldCommand;

test('install command', function () {
    $this->artisan('loom:install')
        ->expectsQuestion('Would you like to star our repo on GitHub?', true)
        ->expectsOutput('Loom installed successfully ✅')
        ->assertSuccessful();
});

test('aliases should expand commands', function () {
    $files = new Filesystem;

    expect(new MakeColumnCommandAlias($files))->toBeInstanceOf(MakeColumnCommand::class);
    expect(new MakeFieldCommandAlias($files))->toBeInstanceOf(MakeFieldCommand::class);
});

test('aliases should be callable', function () {
    $makeFieldTester = $this->artisan('loom:field', [
        'name' => 'test',
        'component' => 'TextInput',
    ]);

    $makeColumnTester = $this->artisan('loom:column', [
        'name' => 'test',
        'column' => 'TextColumn',
    ]);

    $makeFieldTester->assertSuccessful();
    $makeColumnTester->assertSuccessful();
});
