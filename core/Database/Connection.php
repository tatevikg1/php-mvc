<?php

declare(strict_types=1);

namespace Tatevik\Framework\Database;

use PDO;
use Tatevik\Framework\Database\Connector\ConnectorInterface;
use Tatevik\Framework\Database\Connector\MysqlConnector;
use Tatevik\Framework\Database\Connector\SqlLightConnector;
use Tatevik\Framework\Database\Exception\InvalidArgumentException;

class Connection
{
    private Config $config;
    public function __construct(
    ) {
        $this->loadConfig();
    }

    /**
     * @throws InvalidArgumentException
     */
    public function start(): PDO
    {
        $connector = $this->getConnector($this->config);
        return $connector->connect($this->config);
    }

    private function loadConfig(): void
    {
        $this->config = new Config();
        $this->config
            ->setDriver($_ENV['DATABASE_CONNECTION'])
            ->setDatabase($_ENV['DATABASE_NAME'])
            ->setLogin($_ENV['DATABASE_USERNAME'])
            ->setPassword($_ENV['DATABASE_PASSWORD'])
            ->setHost($_ENV['DATABASE_HOST'])
            ->setPort((int)$_ENV['DATABASE_PORT'])
        ;
    }

    /**
     * @throws InvalidArgumentException
     */
    private function getConnector(Config $config): ConnectorInterface
    {
        return match ($config->getDriver()) {
            'mysql' => new MysqlConnector(),
            'sqlite' => new SqlLightConnector(),
            default => throw new InvalidArgumentException("Unsupported driver {$config->getDriver()}."),
        };
    }
}