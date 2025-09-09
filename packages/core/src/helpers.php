<?php

use Loom\LoomManager;

if (! function_exists('loom')) {
    function loom(): LoomManager
    {
        static $loom;

        if (! isset($loom)) {
            /** @var LoomManager */
            $loom = app('loom');
        }

        return $loom;
    }
}
