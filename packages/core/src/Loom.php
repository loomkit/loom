<?php

declare(strict_types=1);

namespace Loom;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string version()
 * @method static string namespace()
 * @method static string name(?string $newName = null)
 * @method static string icon(?string $newIcon = null)
 * @method static string color(?string $newColor = null)
 * @method static string niceName()
 * @method static string logo(?string $newLogo = null)
 * @method static string useSimpleLogo()
 * @method static string useFilledLogo()
 * @method static string basePath(string $path = '')
 * @method static string resourcePath(string $path = '')
 * @method static string distPath(string $path = '')
 * @method static string asset(string $path)
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
