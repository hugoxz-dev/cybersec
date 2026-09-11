<?php

class LabProgress extends Model
{
    public function complete(
        int $userId,
        int $labId
    ): bool {

        $sql = "
            INSERT INTO lab_progress
            (
                user_id,
                lab_id,
                completed,
                completed_at
            )
            VALUES
            (
                :user_id,
                :lab_id,
                1,
                NOW()
            )
            ON DUPLICATE KEY UPDATE
            completed = 1,
            completed_at = NOW()
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':user_id' => $userId,
            ':lab_id' => $labId
        ]);
    }

    public function isCompleted(
        int $userId,
        int $labId
    ): bool {

        $sql = "
            SELECT id
            FROM lab_progress
            WHERE user_id = :user_id
            AND lab_id = :lab_id
            AND completed = 1
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':user_id' => $userId,
            ':lab_id' => $labId
        ]);

        return (bool)$stmt->fetch();
    }

    public function countCompleted(
       int $userId
    ): int {

    $sql = "
        SELECT COUNT(*) total
        FROM lab_progress
        WHERE user_id = :user_id
        AND completed = 1
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':user_id' => $userId
    ]);

    $result = $stmt->fetch();

    return (int)$result['total'];
    }

}