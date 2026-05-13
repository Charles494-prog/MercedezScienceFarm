<?php

// Set environment variables
$_ENV['APP_ENV'] = getenv('APP_ENV') ?: 'production';

// Point to the Laravel public directory
require __DIR__ . '/../public/index.php';