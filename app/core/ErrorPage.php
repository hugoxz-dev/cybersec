<?php

class ErrorPage
{
    public static function render(
        int $status,
        string $title,
        string $message,
        ?Throwable $debug = null
    ): void {

        if (!headers_sent()) {
            http_response_code($status);
        }

        $hideNav = !Auth::check();
        $pageTitle = $title;

        require __DIR__ . '/../views/errors/error.php';
    }

    /**
     * Tratador global: 404 para NotFoundException, 500 genérico para o resto.
     * Detalhes técnicos só aparecem com APP_ENV = 'development'.
     */
    public static function handle(Throwable $e): void
    {
        if ($e instanceof NotFoundException) {
            self::render(404, 'Não encontrado', $e->getMessage());
            return;
        }

        error_log((string)$e);

        self::render(
            500,
            'Algo deu errado',
            'Ocorreu um erro inesperado. Tente novamente em instantes.',
            APP_ENV === 'development' ? $e : null
        );
    }
}
