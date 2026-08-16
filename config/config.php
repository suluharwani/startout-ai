<?php
declare(strict_types=1);

/**
 * Loads the .env file and defines application constants.
 */

if (!function_exists('env_load')) {
    /**
     * Parse a simple KEY=VALUE .env file into an array.
     */
    function env_load(string $path): array
    {
        $vars = [];
        if (!is_file($path)) {
            return $vars;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return $vars;
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
                continue;
            }
            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            if (strlen($value) >= 2) {
                $first = $value[0];
                $last = $value[strlen($value) - 1];
                if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                    $value = substr($value, 1, -1);
                }
            }

            $vars[$key] = $value;
        }

        return $vars;
    }
}

$env = env_load(dirname(__DIR__) . '/.env');

if (!defined('APP_ENV')) {
    define('APP_ENV', $env['APP_ENV'] ?? 'local');
}

if (!defined('APP_NAME')) {
    define('APP_NAME', $env['APP_NAME'] ?? 'Startout AI');
}

if (!defined('APP_TIMEZONE')) {
    define('APP_TIMEZONE', $env['APP_TIMEZONE'] ?? 'Asia/Jakarta');
}

if (!defined('APP_KEY')) {
    define('APP_KEY', $env['APP_KEY'] ?? 'change-me-to-a-random-key');
}

if (!defined('SESSION_NAME')) {
    define('SESSION_NAME', $env['SESSION_NAME'] ?? 'startout_session');
}

if (!defined('DB_HOST')) {
    define('DB_HOST', $env['DB_HOST'] ?? '127.0.0.1');
}

if (!defined('DB_PORT')) {
    define('DB_PORT', $env['DB_PORT'] ?? '3306');
}

if (!defined('DB_NAME')) {
    define('DB_NAME', $env['DB_NAME'] ?? 'startoutai');
}

if (!defined('DB_USER')) {
    define('DB_USER', $env['DB_USER'] ?? 'root');
}

if (!defined('DB_PASS')) {
    define('DB_PASS', $env['DB_PASS'] ?? '');
}

if (!defined('BASE_PATH')) {
    define('BASE_PATH', dirname(__DIR__));
}

if (!defined('VIEW_PATH')) {
    define('VIEW_PATH', BASE_PATH . '/app/Views');
}

if (!defined('UPLOAD_PATH')) {
    define('UPLOAD_PATH', BASE_PATH . '/assets/uploads');
}

if (!defined('UPLOAD_URL')) {
    define('UPLOAD_URL', '/assets/uploads');
}

if (!defined('BASE_URL')) {
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['SERVER_PORT'] ?? '80') === '443');

    $scheme = $https ? 'https' : 'http';
    $host   = $_SERVER['HTTP_HOST'] ?? 'localhost';
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
    $dir    = rtrim(str_replace('\\', '/', dirname($script)), '/');

    // Encode each path segment so folders with spaces still produce valid URLs.
    $segments = array_map('rawurlencode', array_filter(explode('/', $dir), 'strlen'));

    $defaultBase = $scheme . '://' . $host . ($segments ? '/' . implode('/', $segments) : '');

    // Only use APP_URL when it is actually configured (non-empty).
    $configuredBase = isset($env['APP_URL']) && trim((string) $env['APP_URL']) !== ''
        ? $env['APP_URL']
        : $defaultBase;

    define('BASE_URL', rtrim($configuredBase, '/'));
}

date_default_timezone_set(APP_TIMEZONE);
