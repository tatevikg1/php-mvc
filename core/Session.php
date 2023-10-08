<?php

declare(strict_types=1);

namespace Tatevik\Framework;

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
     * @param mixed $value
     */
    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Unsets session data
     * @param string $key
    */
    public static function unset(string $key)
    {
        unset($_SESSION[$key]);
    }
}
