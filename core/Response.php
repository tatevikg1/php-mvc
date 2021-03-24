<?php

namespace app\core;

/**
 * @method void setStatusCode($code)
 * @method void redirect(string $url)
*/
class Response
{

    /**
     * Sets http response status code
     * @param int $code
    */
    public function setStatusCode($code)
    {
        http_response_code($code);
    }

    /**
     * @param string $url
    */
    public function redirect($url)
    {
        // header is a php function to redirect to url
        header('Location: '. $url);
    }

}
