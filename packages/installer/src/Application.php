<?php

declare(strict_types=1);

namespace Loom\Installer;

use Loom\LoomManager;
use Symfony\Component\Console\Application as BaseApplication;

final class Application extends BaseApplication
{
    public function __construct()
    {
        parent::__construct('Loom Installer', LoomManager::VERSION);

        $this->add(new NewCommand);
    }
}
