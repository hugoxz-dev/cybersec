<?php

/**
 * Limite simples de tentativas por janela de tempo, guardado na tabela `attempts`.
 */
class RateLimiter
{
    public static function tooMany(
        string $scope,
        string $identifier,
        int $maxAttempts,
        int $windowSeconds
    ): bool {

        $stmt = Database::getInstance()->prepare("
            SELECT COUNT(*) total
            FROM attempts
            WHERE scope = :scope
            AND identifier = :identifier
            AND created_at > (NOW() - INTERVAL :window SECOND)
        ");

        $stmt->execute([
            ':scope' => $scope,
            ':identifier' => $identifier,
            ':window' => $windowSeconds
        ]);

        return (int)$stmt->fetch()['total'] >= $maxAttempts;
    }

    public static function hit(string $scope, string $identifier): void
    {
        $db = Database::getInstance();

        $db->prepare("
            INSERT INTO attempts (scope, identifier)
            VALUES (:scope, :identifier)
        ")->execute([
            ':scope' => $scope,
            ':identifier' => $identifier
        ]);

        // Limpeza ocasional de registros antigos.
        if (random_int(1, 50) === 1) {
            $db->exec("DELETE FROM attempts WHERE created_at < (NOW() - INTERVAL 1 DAY)");
        }
    }

    public static function clear(string $scope, string $identifier): void
    {
        Database::getInstance()->prepare("
            DELETE FROM attempts
            WHERE scope = :scope
            AND identifier = :identifier
        ")->execute([
            ':scope' => $scope,
            ':identifier' => $identifier
        ]);
    }

    public static function clientIp(): string
    {
        return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    }
}
