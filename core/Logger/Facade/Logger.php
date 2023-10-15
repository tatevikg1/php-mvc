<?php

declare(strict_types=1);

namespace Tatevik\Framework\Logger\Facade;

use ReflectionClass;
use RuntimeException;
use Tatevik\Framework\Logger\FileLogger;
use Tatevik\Framework\Logger\LoggerInterface;

/**
 * @method static error(string $message, ?array $context = null)
 * @method static info(string $message, ?array $context = null)
 * @method static debug(string $message, ?array $context = null)
 * @method static warning(string $message, ?array $context = null)
 * @method static log(string $message, ?array $context = null)
 * @method static critical(string $message, ?array $context = null)
 */
class Logger
{
    private static LoggerInterface $logger;

    public static function __callStatic(string $function, array $arguments = []): void
    {
        self::assertMethodExists($function);
        self::$logger = new FileLogger();
        self::$logger->$function($arguments[0], $arguments[1] ?? null);
    }

    private static function assertMethodExists(string $function): void
    {
        $reflectionClass = new ReflectionClass(Logger::class);
        $pattern = '/@method\s+static\s+([\w]+)\(/';
        $methodNames = [];
        if (preg_match_all($pattern, $reflectionClass->getDocComment(), $matches)) {
            $methodNames = $matches[1];
        }
        if (!in_array($function, $methodNames)) {
            self::error('Method does not exists in class', [
                'method_name' => $function,
                'class_name' => __CLASS__,
            ]);
            throw new RuntimeException('Method does not exists');
        }
    }
}