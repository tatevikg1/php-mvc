<?php

declare(strict_types=1);

namespace Tatevik\Framework\Database\Connector;

use PDO;
use Tatevik\Framework\Database\Config;

interface ConnectorInterface
{
    public function connect(Config $config): PDO;
}