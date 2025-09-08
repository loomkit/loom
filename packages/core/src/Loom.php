<?php

declare(strict_types=1);

namespace Loom;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string version()
 * @method static string namespace()
 * @method static string name()
 * @method static string icon()
 * @method static string niceName()
 * @method static string logo(string $color = 'blue', bool $filled = true)
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
