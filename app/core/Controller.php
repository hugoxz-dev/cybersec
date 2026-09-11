<?php

abstract class Controller
{
    protected function view(string $view, array $data = []): void
    {
        extract($data);

       $file = __DIR__ . '/../views/' . $view . '.php';

if (!file_exists($file)) {

    throw new Exception(
        "View {$view} não encontrada."
    );
}

require_once $file;
    }

    protected function redirect(string $route): void
    {
        header('Location: ' . BASE_URL . '/' . $route);
        exit;
    }
}
