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

    public static function baseStoragePath($path = ''): string
    {
        $basePath = self::basePath('storage');

        if (!empty($path)) {
            $basePath .=  '/' . $path;
        }

        return $basePath;
    }
}