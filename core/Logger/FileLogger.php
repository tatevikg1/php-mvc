<?php

declare(strict_types=1);

namespace Tatevik\Framework\Logger;

use Tatevik\Framework\Helper;

class FileLogger implements LoggerInterface
{
    protected array $logLevels = [
        'info',
        'warning',
        'log',
        'debug',
        'error',
        'critical',
    ];

    public function __construct(private string $logLevel = 'warning')
    {
        $this->logLevel = $_ENV['LOG_LEVEL'] ?? $this->logLevels[0];
    }

    public function __call(string $function, array $arguments): void
    {
        if (!$this->assertLogLevel($function, $this->logLevel)) {
            return;
        }

        $this->log($function,  $arguments[0], $arguments[1] ?? []);
    }

    public function log(string $logLevel, string $message, ?array $context = []): void
    {
        $fileName = $this->getFileName($logLevel);
        $this->writeLog($fileName, $logLevel,  $message, $context);
    }

    private function writeLog(string $fileName, string $level, string $message, ?array $context = []): void
    {
        $stream = fopen($fileName, 'a');

        $data = [
            $level,
            'DATE: ' .  date("Y-m-d H:i:s"),
            'MESSAGE: ' . $message,
            'CONTEXT: ' . serialize($context)
        ];
        $text = implode(' | ', $data);
        fwrite($stream,$text . PHP_EOL);
        fclose($stream);
    }

    private function assertLogLevel(string $logLevel, string $setLevel): bool
    {
        return (
            array_search($logLevel, $this->logLevels)
            >=
            array_search($setLevel, $this->logLevels)
        );
    }

    private function getFileName(string $logLevel): string
    {
        if (
            array_search($logLevel, $this->logLevels)
            <=
            array_search('debug', $this->logLevels)
        ) {
            return Helper::baseStoragePath('logs') . '/framework.log';
        }
        return Helper::baseStoragePath('logs') . '/errors.log';
    }
}