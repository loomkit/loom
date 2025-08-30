<?php

declare(strict_types=1);

namespace Loom;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string getVersion()
 *
 * @see \Loom\LoomManager
 */
class Loom extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'loom';
    }
}
