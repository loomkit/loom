<?php

declare(strict_types=1);

namespace Loom\Tests\Installer;

use Laravel\Installer\Console\Concerns\InteractsWithHerdOrValet;
use Loom\Tests\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use InteractsWithHerdOrValet;

    public function rmdir(string $dir): void
    {
        if (is_dir($dir)) {
            if (PHP_OS_FAMILY == 'Windows') {
                exec("rd /s /q \"$dir\"");
            } else {
                exec("rm -rf \"$dir\"");
            }
        }
    }
}
