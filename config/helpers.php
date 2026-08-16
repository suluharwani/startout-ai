<?php
declare(strict_types=1);

/**
 * Global helper functions used across views and controllers.
 */

use App\Models\Setting;

/* ── Escaping / URLs ─────────────────────────────────────────── */

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function url(string $path = ''): string
{
    return BASE_URL . '/' . ltrim($path, '/');
}

function asset(string $path): string
{
    return BASE_URL . '/' . ltrim($path, '/');
}

function redirect(string $path): void
{
    header('Location: ' . url($path));
    exit;
}

function redirect_back(array $fallback = []): void
{
    $back = $_SERVER['HTTP_REFERER'] ?? null;
    if ($back && str_starts_with($back, BASE_URL)) {
        header('Location: ' . $back);
        exit;
    }
    redirect($fallback[0] ?? '/');
}

function current_path(): string
{
    $uri    = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
    $dir    = rtrim(str_replace('\\', '/', dirname($script)), '/');

    if ($dir !== '' && $dir !== '/' && str_starts_with($uri, $dir)) {
        $uri = substr($uri, strlen($dir));
    }

    return '/' . ltrim(urldecode($uri), '/');
}

/* ── Old input / flash messages ──────────────────────────────── */

function old(string $key, string $default = ''): string
{
    return isset($_SESSION['_old'][$key]) ? (string) $_SESSION['_old'][$key] : $default;
}

function flash(string $key, ?string $value = null): ?string
{
    if ($value !== null) {
        $_SESSION['_flash'][$key] = $value;
        return null;
    }

    if (isset($_SESSION['_flash'][$key])) {
        $message = $_SESSION['_flash'][$key];
        unset($_SESSION['_flash'][$key]);
        return $message;
    }

    return null;
}

function flash_errors(array $errors): void
{
    $_SESSION['_errors'] = $errors;
}

function error_for(string $key): ?string
{
    if (!empty($_SESSION['_errors'][$key])) {
        return (string) $_SESSION['_errors'][$key];
    }
    return null;
}

function clear_errors(): void
{
    unset($_SESSION['_errors']);
}

/* ── CSRF protection ─────────────────────────────────────────── */

function csrf_token(): string
{
    return $_SESSION['_csrf'] ?? '';
}

function csrf_field(): string
{
    return '<input type="hidden" name="_token" value="' . e(csrf_token()) . '">';
}

/**
 * Validate the CSRF token sent with a POST request.
 */
function csrf_check(): bool
{
    $token = $_POST['_token'] ?? '';
    return is_string($token) && hash_equals(csrf_token(), $token);
}

/**
 * Guard a POST route with CSRF. Shows 419 on failure.
 */
function csrf_guard(): void
{
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && !csrf_check()) {
        http_response_code(419);
        exit('419 — Session expired. Please go back, refresh the page and try again.');
    }
}

/* ── Settings (cached per request) ───────────────────────────── */

function all_settings(): array
{
    static $cache = null;
    if ($cache === null) {
        $cache = Setting::allAsMap();
    }
    return $cache;
}

function setting(string $key, string $default = ''): string
{
    $all = all_settings();
    return array_key_exists($key, $all) ? (string) $all[$key] : $default;
}

/* ── Company helpers ─────────────────────────────────────────── */

function company_name(): string
{
    return setting('company_name', APP_NAME);
}

function company_email(): string
{
    return setting('company_email', 'hi@startoutai.com');
}

function company_phone(): string
{
    return setting('company_phone', '628602268666');
}

/**
 * WhatsApp deep-link used for every "Schedule Consultation" CTA.
 */
function wa_link(string $message = ''): string
{
    $number = preg_replace('/[^0-9]/', '', company_phone());
    $text   = $message !== '' ? '?text=' . rawurlencode($message) : '';
    return 'https://wa.me/' . $number . $text;
}

function tel_link(): string
{
    return 'tel:+' . preg_replace('/[^0-9]/', '', company_phone());
}

/* ── Auth ────────────────────────────────────────────────────── */

function auth_check(): bool
{
    return !empty($_SESSION['admin_id']);
}

function auth_user(): ?array
{
    return $_SESSION['admin_user'] ?? null;
}

function require_admin(): void
{
    if (!auth_check()) {
        $_SESSION['_redirect'] = current_path();
        redirect('/admin/login');
    }
}

function admin_logout(): void
{
    unset($_SESSION['admin_id'], $_SESSION['admin_user'], $_SESSION['_redirect']);
    session_regenerate_id(true);
}

/* ── Misc ────────────────────────────────────────────────────── */

function format_date(?string $date, string $format = 'd M Y'): string
{
    if (!$date) {
        return '-';
    }
    try {
        return (new DateTimeImmutable($date))->format($format);
    } catch (Throwable) {
        return '-';
    }
}

function truncate(string $text, int $length = 120): string
{
    $text = trim(strip_tags($text));
    if (mb_strlen($text) <= $length) {
        return $text;
    }
    return rtrim(mb_substr($text, 0, $length), " \t\n\r\0\x0B.,") . '…';
}

function is_active_path(string $path): string
{
    return current_path() === $path ? 'active' : '';
}

/**
 * Read the request body safely (used by fetch() posts).
 */
function request_input(string $key, string $default = ''): string
{
    $value = $_POST[$key] ?? $default;
    return is_string($value) ? trim($value) : $default;
}

/**
 * Convert any string into a URL-safe slug.
 */
function slugify(string $text): string
{
    $text = strtolower(trim($text));
    $text = str_replace(['ä', 'ö', 'ü', 'ß'], ['ae', 'oe', 'ue', 'ss'], $text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text) ?? '';
    return trim($text, '-');
}

/* ── View rendering ──────────────────────────────────────────── */

/**
 * Render a view inside a shared layout.
 *
 * @param array<string, mixed> $data
 */
function render(string $view, array $data = [], string $layout = 'main'): void
{
    extract($data, EXTR_SKIP);

    ob_start();
    require VIEW_PATH . '/' . $view . '.php';
    $content = ob_get_clean();

    require VIEW_PATH . '/layouts/' . $layout . '.php';
}
