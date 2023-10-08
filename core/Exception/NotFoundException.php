<?php

declare(strict_types=1);

namespace Tatevik\Framework\Exception;

use Exception;

/**
 * @var int $code
 * @var string $message
*/
class NotFoundException extends Exception
{
    protected $code = 404;
    protected $message = 'Page is not found';
}

