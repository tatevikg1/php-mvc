<?php

namespace app\core;

class DB
{
    public static function prepare($sqlStatment)
    {
        return Application::$app->PDO->prepare($sqlStatment);
    }

    public static function query($sqlStatment)
    {
        return Application::$app->PDO->query($sqlStatment);

    }

    public static function lastInsertId()
    {
        return Application::$app->PDO->lastInsertId();
    }

}
