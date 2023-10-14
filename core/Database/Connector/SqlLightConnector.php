<?php

declare(strict_types=1);

namespace Tatevik\Framework\Database\Connector;

use PDO;
use Tatevik\Framework\Database\Config;
use Tatevik\Framework\Helper;

class SqlLightConnector implements ConnectorInterface
{
    public function connect(Config $config): PDO
    {
        $pdo = new PDO($config->getDriver() . ':' . Helper::basePath() . '/.sqlite3');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}