<?php

declare(strict_types=1);

namespace Tatevik\Framework\Request;

class Request
{
    public function __construct(
        public readonly array $getParams,
        public readonly array $postParams,
        public readonly array $cookies,
        public readonly array $files,
        public readonly array $server,
    ) { }

    public static function createFromGlobals(): static
    {
        return new self($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
    }

    /**
     * Returns the path part of $_SERVER['REQUEST_URI'](before the '?' symbol)
     * @return string $path
    */
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, "?");

        if ($position === false) {
            return $path;
        }
        // take the string $path from [0] until first "?", from where starts the post request data
        return substr($path, 0, $position);
    }

    /**
     * returns lowercase request method
     * @return string $_SERVER['REQUEST_METHOD']
    */
    public function method(): string
    {        
        return  strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * returns sanitized data from super global _GET or _POST
     * @return array $body
    */
    public function data(): array
    {
        $body = [];

        if ($this->method() == 'get')
        {
            foreach ($_GET as $key => $value) {
                // INPUT_GET will look at super global _GET, will look at $key and take its array_count_values
                // remove invalid chars and put it in body
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() == 'post')
        {
            foreach ($_POST as $key => $value) {
                // INPUT_POST will look at super global _POST, will look at $key and take its array_count_values
                // remove invalid chars and put it in body
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}
