<?php
declare(strict_types=1);

namespace App\Controllers;

/**
 * Base controller — shared rendering helpers.
 */
abstract class Controller
{
    /**
     * Render a view inside a layout.
     *
     * @param array<string, mixed> $data
     */
    protected function view(string $view, array $data = [], string $layout = 'main'): void
    {
        render($view, $data, $layout);
    }

    protected function json(mixed $data, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
