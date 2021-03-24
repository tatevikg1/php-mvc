<?php

namespace app\core;

/**
 * @method void set(string $key, $value)
 * @method void unset(string $key)
*/
class Session
{
    function __construct()
    {
        session_start();
    }

    /**
     * Sets session data
     * @param string $key
    */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Unsets session data
     * @param string $key
    */
    public static function unset($key)
    {
        unset($_SESSION[$key]);
    }

}
