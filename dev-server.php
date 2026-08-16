<?php
/**
 * Development router for `php -S` built-in server.
 *
 * Usage (from project root):
 *   php -S localhost:8000 dev-server.php
 *
 * Returns false for real files/assets so the built-in server can
 * serve them, otherwise routes everything to index.php.
 */
declare(strict_types=1);

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$file = __DIR__ . str_replace('/', DIRECTORY_SEPARATOR, urldecode($path));

if ($path !== '/' && is_file($file)) {
    return false;
}

require __DIR__ . '/index.php';
