<?php

declare(strict_types=1);

namespace Tatevik\Framework;

class Response
{
    /**
     * Sets http response status code
     * @param int $code
    */
    public function setStatusCode(int $code): void
    {
        http_response_code($code);
    }

    /**
     * @param string $url
    */
    public function redirect(string $url): void
    {
        header('Location: '. $url);
    }
}
