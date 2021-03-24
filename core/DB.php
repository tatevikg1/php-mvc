<?php

declare(strict_types=1);

namespace app\core;

use PDOStatement;

class DB
{
    /**
     * Prepares a statement for execution and returns a statement object
     * @param string $sqlStatement
     * @return false|PDOStatement
    */
    public static function prepare(string $sqlStatement)
    {
        return Application::$app->PDO->prepare($sqlStatement);
    }

    /**
     * Executes an SQL statement, returning a result set as a PDOStatement object
     * @param mixed $sqlStatement
     * @return PDOStatement|false
    */
    public static function query($sqlStatement)
    {
        return Application::$app->PDO->query($sqlStatement);
    }

    /**
     * Returns the ID of the last inserted row or sequence value
     * @return string
    */
    public static function lastInsertId(): string
    {
        return Application::$app->PDO->lastInsertId();
    }
}
