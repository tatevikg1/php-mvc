<?php

declare(strict_types=1);

namespace app\core\middleware;

interface BaseMiddleware
{
    public function execute();
}
