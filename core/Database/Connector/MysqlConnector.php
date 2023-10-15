<?php

declare(strict_types=1);

namespace Tatevik\Framework\Database\Connector;

use Exception;
use PDO;
use Tatevik\Framework\Database\Config;
use Tatevik\Framework\Database\Exception\DatabaseConnectionException;
use Tatevik\Framework\Logger\Facade\Logger;

class MysqlConnector implements ConnectorInterface
{
    protected array $options = [
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
        PDO::ATTR_STRINGIFY_FETCHES => false,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    public function connect(Config $config): PDO
    {
        $dsn = $this->getDnsFromConfig($config);

        return $this->createConnection($dsn, $config, $this->options);
    }

    private function getDnsFromConfig(Config $config): string
    {
        return "mysql:host={$config->getHost()};port={$config->getPort()};dbname={$config->getDatabase()}";
    }

    /**
     * @throws DatabaseConnectionException
     */
    private function createConnection($dsn, Config $config, array $options): PDO
    {
        try {
            return new PDO(
                $dsn, $config->getLogin(), $config->getPassword(), $options
            );
        } catch (Exception $exception) {
            Logger::critical('Database connection error', [
                'class_name' => __CLASS__,
                'exception' => $exception,
            ]);
            throw new DatabaseConnectionException('Database connection error');
        }
    }
}