<?php

namespace Tatevik\Framework\Logger;

interface LoggerInterface
{
    public function log(string $logLevel, string $message, ?array $context = []): void;
}