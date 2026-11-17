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
            throw new NotFoundException('Página não encontrada.');
        }

        // Todo POST precisa do token CSRF da sessão.
        if ($method === 'POST' && !Csrf::verify()) {
            ErrorPage::render(
                403,
                'Sessão expirada',
                'O formulário expirou ou veio de outro site. Volte, recarregue a página e tente de novo.'
            );
            return;
        }

        [$controllerName, $methodName] = $this->routes[$method][$uri];

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

        $controller->$methodName();
    }
}
