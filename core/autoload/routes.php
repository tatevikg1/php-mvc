<?php

$directory = __DIR__ . '/../../config/routes/';

if (is_dir($directory)) {
    $files = scandir($directory);

    $files = array_diff($files, ['.', '..']);

    foreach ($files as $file) {
        $filePath = $directory . '/' . $file;

        if (is_file($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'php') {
            require_once $filePath;
        }
    }
} else {
    echo "Routes directory not found.";
}