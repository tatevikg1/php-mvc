<?php

declare(strict_types=1);

namespace app\core;

class Response
{

    /**
     * Sets http response status code
     * @param int $code
    */
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    /**
     * @param string $url
    */
    public function redirect(string $url)
    {
        // header is a php function to redirect to url
        header('Location: '. $url);
    }
}
