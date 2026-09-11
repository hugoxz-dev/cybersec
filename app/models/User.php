<?php

class User extends Model
{
    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO users
            (
                name,
                email,
                password
            )
            VALUES
            (
                :name,
                :email,
                :password
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => password_hash(
                $data['password'],
                PASSWORD_DEFAULT
            )
        ]);
    }

    public function findByEmail(string $email): ?array
    {
        $sql = "
            SELECT *
            FROM users
            WHERE email = :email
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':email' => $email
        ]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function findById(int $id): ?array
    {
        $sql = "
            SELECT *
            FROM users
            WHERE id = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $user = $stmt->fetch();

        return $user ?: null;
    }

    public function updateProfile(
        int $id,
        string $name,
        string $email,
        ?string $photo = null
    ): bool {

        if ($photo) {

            $sql = "
                UPDATE users
                SET
                    name = :name,
                    email = :email,
                    photo = :photo
                WHERE id = :id
            ";

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':photo' => $photo,
                ':id' => $id
            ]);
        }

        $sql = "
            UPDATE users
            SET
                name = :name,
                email = :email
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':id' => $id
        ]);
    }

    public function updatePassword(
        int $id,
        string $password
    ): bool {

        $sql = "
            UPDATE users
            SET password = :password
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':password' => password_hash(
                $password,
                PASSWORD_DEFAULT
            ),
            ':id' => $id
        ]);
    }

    public function emailExists(
        string $email,
        int $ignoreId
    ): bool {

        $sql = "
            SELECT id
            FROM users
            WHERE email = :email
            AND id <> :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':email' => $email,
            ':id' => $ignoreId
        ]);

        return (bool) $stmt->fetch();
    }

     public function countSolvedChallenges(
     int $userId
     ): int {

    $sql = "
        SELECT COUNT(DISTINCT challenge_id) total
        FROM submissions
        WHERE user_id = :user_id
        AND is_correct = 1
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':user_id' => $userId
    ]);

    $result = $stmt->fetch();

    return (int)$result['total'];
    }

    public function getDashboardStats(
      int $userId
    ): array {

    $user = $this->findById($userId);

    $level = $this->getCurrentLevel(
        $userId
    );

    return [
        'xp' => (int)$user['xp'],
        'level' => $level['name'] ?? 'Iniciante',
        'solved' => $this->countSolvedChallenges(
            $userId
        )
    ];
 }

    public function getCurrentLevel(
      int $userId
    ): array {

    $sql = "
        SELECT l.*
        FROM users u
        INNER JOIN levels l
            ON l.id = u.level_id
        WHERE u.id = :id
        LIMIT 1
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':id' => $userId
    ]);

    $level = $stmt->fetch();

    return $level ?: [
        'id' => 1,
        'name' => 'Iniciante'
    ];
 }

    public function addXp(
     int $userId,
     int $xp
    ): bool {

    $sql = "
        UPDATE users
        SET xp = xp + :xp
        WHERE id = :id
    ";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ':xp' => $xp,
        ':id' => $userId
    ]);
 }

     public function updateLevel(
        int $userId
    ): void {

    $user = $this->findById(
        $userId
    );

    $xp = (int)$user['xp'];

    $sql = "
        SELECT id
        FROM levels
        WHERE xp_required <= :xp
        ORDER BY xp_required DESC
        LIMIT 1
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':xp' => $xp
    ]);

    $level = $stmt->fetch();

    if (!$level) {
        return;
    }

    $sql = "
        UPDATE users
        SET level_id = :level_id
        WHERE id = :id
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':level_id' => $level['id'],
        ':id' => $userId
    ]);
 }

}