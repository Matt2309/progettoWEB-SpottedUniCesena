<?php

$env = static function(string $key, $default = null) {
    $val = getenv($key);
    return $val !== false && $val !== '' ? $val : $default;
};

return [
    'db' => [
        'host' => $env('DB_HOST', 'localhost'),
        'port' => (int)$env('DB_PORT', 3306), // On macOS MAMP default may be 8889; override with DB_PORT=8889
        'name' => $env('DB_NAME', 'spotted_db'),
        'user' => $env('DB_USER', 'root'),
        'pass' => $env('DB_PASS', 'root'), // On Windows/XAMPP often empty password; set DB_PASS=""
        'charset' => $env('DB_CHARSET', 'utf8mb4'),
    ]
];
