<?php

use Kernel\Contracts\Router\RouterInterface;

class Router
{
    private array $routes;

    public function add(string $method, string $path, callable $callback): void
    {
        $this->routes[] = compact('method', 'path', 'callback');
    }

    public function dispatch(): mixed
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                return call_user_func($route['callback'], $_GET);
            }
        }

        http_response_code(404);
        return json_encode(['error' => 'Endpoint not found']);
    }
}