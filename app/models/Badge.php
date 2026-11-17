<?php

class Badge extends Model
{
    // IDs da tabela `badges`. Mantidos aqui em um só lugar.
    public const FIRST_LOGIN = 1;

    // desafios resolvidos => badge
    private const CHALLENGE_BADGES = [1 => 2, 5 => 3, 10 => 4];

    // XP total => badge
    private const XP_BADGES = [100 => 5, 500 => 6, 1000 => 7];

    public function checkAndAward(int $userId): void
    {
        $userModel = new User();

        $solved = $userModel->countSolvedChallenges($userId);

        foreach (self::CHALLENGE_BADGES as $needed => $badgeId) {
            if ($solved >= $needed) {
                $this->award($userId, $badgeId);
            }
        }

        $xp = (int)($userModel->findById($userId)['xp'] ?? 0);

        foreach (self::XP_BADGES as $needed => $badgeId) {
            if ($xp >= $needed) {
                $this->award($userId, $badgeId);
            }
        }
    }

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