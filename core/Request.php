<?php

namespace app\core;

class Request
{

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, "?");

        if($position === false){
            return $path;
        }
        // take the string $path from [0] untill first "?", from where starts the post request data
        $path = substr($path, 0, $position);
        return $path;

    }

    public function method()
    {        
        return  strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function data()
    {
        $body = [];

        if ($this->method() == 'get')
        {
            foreach ($_GET as $key => $value) {
                // INPUT_GET will look at superglobal _GET, will look at $key and take its array_count_values
                // remove invalid chars and put it in body
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() == 'post')
        {
            foreach ($_POST as $key => $value) {
                // INPUT_POST will look at superglobal _POST, will look at $key and take its array_count_values
                // remove invalid chars and put it in body
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        // returns now sanitized data
        return $body;

    }


}
