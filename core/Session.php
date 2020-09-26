<?php

namespace app\core;

class Session
{

    function __construct()
    {
        session_start();
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function unset($key)
    {
        unset($_SESSION[$key]);
    }

}
