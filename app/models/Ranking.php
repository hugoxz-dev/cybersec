<?php

class Ranking extends Model
{
    public function getRanking(): array
    {
        $sql = "
            SELECT
                u.id,
                u.name,
                u.xp,
                l.name AS level_name,
                COUNT(DISTINCT s.challenge_id) AS solved
            FROM users u

            LEFT JOIN levels l
                ON l.id = u.level_id

            LEFT JOIN submissions s
                ON s.user_id = u.id
                AND s.is_correct = 1

            GROUP BY
                u.id,
                u.name,
                u.xp,
                l.name

            ORDER BY u.xp DESC
        ";

        return $this->db
            ->query($sql)
            ->fetchAll();
    }
}