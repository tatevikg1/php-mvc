<?php

namespace app\core;

/**
 * @method statement object prepare($sqlStatment)
 * @method \PDOStatement|false query($sqlStatment)
 * @method string lastInsertId()
*/
class DB
{
    /**
     * Prepares a statement for execution and returns a statement object
     * @param string $sqlStatment
     * @return statement object
    */
    public static function prepare($sqlStatment)
    {
        return Application::$app->PDO->prepare($sqlStatment);
    }

    /**
     * Executes an SQL statement, returning a result set as a PDOStatement object
     * @param mixed $sqlStatment
     * @return \PDOStatement|false
    */
    public static function query($sqlStatment)
    {
        return Application::$app->PDO->query($sqlStatment);
    }

    /**
     * Returns the ID of the last inserted row or sequence value
     * @return string
    */
    public static function lastInsertId()
    {
        return Application::$app->PDO->lastInsertId();
    }

}
