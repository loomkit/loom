<?php

declare(strict_types=1);

use Illuminate\Filesystem\Filesystem;
use Loom\Commands\Aliases\InstallCommand as InstallCommandAlias;
use Loom\Commands\Aliases\MakeColumnCommand as MakeColumnCommandAlias;
use Loom\Commands\Aliases\MakeFieldCommand as MakeFieldCommandAlias;
use Loom\Commands\InstallCommand;
use Loom\Commands\MakeColumnCommand;
use Loom\Commands\MakeFieldCommand;

test('aliases should expand commands', function () {
    $files = new Filesystem;

    expect(new InstallCommandAlias)->toBeInstanceOf(InstallCommand::class);
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
