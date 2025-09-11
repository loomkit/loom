<?php

declare(strict_types=1);

use Loom\Installer\Application;
use Loom\Installer\Commands\NewCommand;
use Loom\LoomManager;
use Symfony\Component\Console\Tester\CommandTester;

uses(\Loom\Tests\Installer\TestCase::class);

it('can scaffold a new loom app', function () {
    $scaffoldDirectoryName = 'tests-output/my-loom-app';
    $scaffoldDirectory = __DIR__.'/../../'.$scaffoldDirectoryName;
    $this->rmdir($scaffoldDirectory);

    $app = new Application;

    $tester = new CommandTester($app->find('new'));

    $statusCode = $tester->execute(['name' => $scaffoldDirectoryName], ['interactive' => false]);

    $this->assertSame(0, $statusCode);
    $this->assertDirectoryExists($scaffoldDirectory.'/vendor');
    $this->assertFileExists($scaffoldDirectory.'/.env');
});

test('on at least loom'.LoomManager::VERSION, function () {
    $command = new NewCommand;

    $onLoomStarterKit = $command->usingLoomVersionOrNewer((int) LoomManager::VERSION, __DIR__.'/fixtures/starter');

    $this->assertTrue($onLoomStarterKit);

});
