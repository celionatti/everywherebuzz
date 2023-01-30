<?php

/**
 * User: Celio Natti
 * Date: 30/01/2023
 * Time: 06:47 PM
 */

namespace app\core;


/**
 * Class Config
 *
 * @author Celio Natti <Celionatti@gmail.com>
 * @package app\core
 */

class Config
{
    private static $config = [
        'version' => '1.0.0',
        'layout' => 'main', // Default layout that is used
        'php_version' => '7.4',
    ];

    public static function get($key)
    {
        if (array_key_exists($key, $_ENV))
            return $_ENV[$key];
        return array_key_exists($key, self::$config) ? self::$config[$key] : NULL;
    }
}