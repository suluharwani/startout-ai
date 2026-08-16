<?php
declare(strict_types=1);

/**
 * Application bootstrap — wires up autoloading, session, CSRF and DB.
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/helpers.php';

/* ── Simple PSR-4 autoloader for the App\ namespace ── */
spl_autoload_register(static function (string $class): void {
    $prefix = 'App\\';
    if (!str_starts_with($class, $prefix)) {
        return;
    }

    $relative = substr($class, strlen($prefix));
    $file     = BASE_PATH . '/app/' . str_replace('\\', '/', $relative) . '.php';

    if (is_file($file)) {
        require $file;
    }
});

/* ── Session ── */
if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => APP_ENV === 'production' && (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
    ]);
    session_start();
}

/* ── CSRF token (regenerated when old) ── */
if (empty($_SESSION['_csrf'])) {
    $_SESSION['_csrf'] = bin2hex(random_bytes(32));
}

/* ── Database (auto-installs schema on first run) ── */
\App\Core\Database::boot();
