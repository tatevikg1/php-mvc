<?php

declare(strict_types=1);

namespace Tatevik\Framework\Exception;

use Exception;

/**
 * @var int $code
 * @var string $message
*/
class ForbiddenException extends Exception
{
    protected $code = 403;
    protected $message = 'You don\'t have permission to access this page';
}

