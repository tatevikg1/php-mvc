<?php

namespace Tatevik\Framework;

class Helper
{
    public static function basePath($path = ''): string
    {
        $basePath = __DIR__ . '/..';

        if (!empty($path)) {
            $basePath .= '/' . $path;
        }

        return $basePath;
    }
}