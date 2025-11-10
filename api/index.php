<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Vercel serverless environment setup
if (isset($_ENV['VERCEL']) || isset($_ENV['LAMBDA_TASK_ROOT'])) {
    // Create necessary temp directories
    $tmpDirs = [
        '/tmp/storage',
        '/tmp/storage/framework',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/views',
        '/tmp/views',
        '/tmp/cache',
    ];

    foreach ($tmpDirs as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }
}

require __DIR__ . "/../public/index.php";
