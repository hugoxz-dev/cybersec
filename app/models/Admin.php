<?php

class Admin extends Model
{
    public function getStats(): array
    {
        $users = $this->db
            ->query("SELECT COUNT(*) total FROM users")
            ->fetch();

        $challenges = $this->db
            ->query("SELECT COUNT(*) total FROM challenges")
            ->fetch();

        $submissions = $this->db
            ->query("SELECT COUNT(*) total FROM submissions")
            ->fetch();

        $correct = $this->db
            ->query("
                SELECT COUNT(*) total
                FROM submissions
                WHERE is_correct = 1
            ")
            ->fetch();

        return [

    'users' => $users['total'],

    'challenges' => $challenges['total'],

    'submissions' => $submissions['total'],

    'correct' => $correct['total'],

    'accuracy' =>

        $submissions['total'] > 0

        ? round(
            ($correct['total'] * 100)
            / $submissions['total'],
            2
        )

        : 0
      ];
    }

    public function getRecentUsers(): array
    {
    $sql = "
        SELECT
            id,
            name,
            email,
            created_at
        FROM users
        ORDER BY created_at DESC
        LIMIT 5
    ";

    return $this->db
        ->query($sql)
        ->fetchAll();
    }

    public function getTopChallenges(): array
    {
    $sql = "
        SELECT
            c.title,
            COUNT(s.id) total
        FROM challenges c

        LEFT JOIN submissions s
            ON s.challenge_id = c.id
            AND s.is_correct = 1

        GROUP BY c.id

        ORDER BY total DESC

        LIMIT 5
    ";

    return $this->db
        ->query($sql)
        ->fetchAll();
    }

}