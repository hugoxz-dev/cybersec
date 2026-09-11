<?php

class Router
{
    private array $routes = [];

    public function get(string $route, array $action): void
    {
        $this->routes['GET'][$route] = $action;
    }

    public function post(string $route, array $action): void
    {
        $this->routes['POST'][$route] = $action;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $uri = parse_url(
            $_SERVER['REQUEST_URI'],
            PHP_URL_PATH
        );

         $basePath = dirname(
         $_SERVER['SCRIPT_NAME']
        );

        $uri = str_replace($basePath, '', $uri);

        if ($uri === '') {
            $uri = '/';
        }

        if (!isset($this->routes[$method][$uri])) {

            http_response_code(404);

            echo "<h1>404 - Página não encontrada</h1>";

            exit;
        }

        $action = $this->routes[$method][$uri];

        $controllerName = $action[0];
        $methodName = $action[1];

       if (!class_exists($controllerName)) {

    throw new Exception(
        "Controller {$controllerName} não encontrado."
    );
}

$controller = new $controllerName();

if (!method_exists($controller, $methodName)) {

    throw new Exception(
        "Método {$methodName} não encontrado em {$controllerName}."
    );
}

call_user_func([
    $controller,
    $methodName
]);
    }
}