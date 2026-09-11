<?php

class Badge extends Model
{
    public function award(
        int $userId,
        int $badgeId
    ): bool {

        $sql = "
            INSERT IGNORE
            INTO user_badges
            (
                user_id,
                badge_id
            )
            VALUES
            (
                :user_id,
                :badge_id
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':user_id' => $userId,
            ':badge_id' => $badgeId
        ]);
    }

    public function getUserBadges(
        int $userId
    ): array {

        $sql = "
            SELECT
                b.*
            FROM badges b

            INNER JOIN user_badges ub
                ON ub.badge_id = b.id

            WHERE ub.user_id = :user_id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':user_id' => $userId
        ]);

        return $stmt->fetchAll();
    }
}