<?php

class Csrf
{
    private const KEY = '_csrf_token';

    public static function token(): string
    {
        $token = Session::get(self::KEY);

        if (!is_string($token) || $token === '') {
            $token = bin2hex(random_bytes(32));
            Session::set(self::KEY, $token);
        }

        return $token;
    }

    public static function field(): string
    {
        return '<input type="hidden" name="_csrf" value="'
            . htmlspecialchars(self::token())
            . '">';
    }

    public static function verify(): bool
    {
        $sent = $_POST['_csrf'] ?? '';
        $token = Session::get(self::KEY);

        return is_string($sent)
            && is_string($token)
            && $token !== ''
            && hash_equals($token, $sent);
    }
}
