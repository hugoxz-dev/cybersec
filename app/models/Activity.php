<?php

class Activity extends Model
{
    public function create(
        int $userId,
        string $action,
        string $description
    ): bool {

        $sql = "
            INSERT INTO activities
            (
                user_id,
                action,
                description
            )
            VALUES
            (
                :user_id,
                :action,
                :description
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':user_id' => $userId,
            ':action' => $action,
            ':description' => $description
        ]);
    }

    public function getRecentByUser(
        int $userId,
        int $limit = 10
    ): array {

        $sql = "
            SELECT *
            FROM activities
            WHERE user_id = :user_id
            ORDER BY created_at DESC
            LIMIT {$limit}
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':user_id' => $userId
        ]);

        return $stmt->fetchAll();
    }
}