<?php
declare(strict_types=1);

namespace App\Core;

use Closure;

/**
 * Lightweight front-controller router.
 *
 * Supports:
 *   - GET / POST / ANY methods
 *   - {param} placeholders in routes
 *   - Closures or "Controller@method" handlers
 *   - Automatic base-path detection (works in sub-folders)
 */
final class Router
{
    /** @var array<int, array{method:string, pattern:string, handler:mixed}> */
    private array $routes = [];

    private string $path;

    public function __construct()
    {
        $this->path = $this->resolvePath();
    }

    public function get(string $route, mixed $handler): void
    {
        $this->add('GET', $route, $handler);
    }

    public function post(string $route, mixed $handler): void
    {
        $this->add('POST', $route, $handler);
    }

    public function any(string $route, mixed $handler): void
    {
        $this->add('ANY', $route, $handler);
    }

    private function add(string $method, string $route, mixed $handler): void
    {
        $this->routes[] = [
            'method'  => $method,
            'pattern' => $this->compile($route),
            'handler' => $handler,
        ];
    }

    private function compile(string $route): string
    {
        $route = preg_replace('/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/', '(?P<$1>[^/]+)', $route);
        return '#^' . $route . '$#';
    }

    private function resolvePath(): string
    {
        $uri    = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
        $dir    = rtrim(str_replace('\\', '/', dirname($script)), '/');

        if ($dir !== '' && $dir !== '/' && str_starts_with($uri, $dir)) {
            $uri = substr($uri, strlen($dir));
        }

        return '/' . ltrim(urldecode($uri), '/');
    }

    public function dispatch(): void
    {
        $method = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');

        foreach ($this->routes as $route) {
            if ($route['method'] !== 'ANY' && $route['method'] !== $method) {
                continue;
            }

            if (preg_match($route['pattern'], $this->path, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $this->invoke($route['handler'], $params);
                return;
            }
        }

        // No route matched → 404.
        http_response_code(404);
        $this->invoke('PageController@notFound');
    }

    private function invoke(mixed $handler, array $params = []): void
    {
        if ($handler instanceof Closure) {
            $handler(...$params);
            return;
        }

        if (is_string($handler) && str_contains($handler, '@')) {
            [$class, $method] = explode('@', $handler, 2);
            $class = 'App\\Controllers\\' . $class;

            if (!class_exists($class)) {
                http_response_code(500);
                exit("Controller not found: {$class}");
            }

            $controller = new $class();

            if (!method_exists($controller, $method)) {
                http_response_code(500);
                exit("Controller method not found: {$class}@{$method}");
            }

            $controller->{$method}(...$params);
            return;
        }

        http_response_code(500);
        exit('Invalid route handler.');
    }
}
