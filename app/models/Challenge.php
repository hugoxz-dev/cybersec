<?php

class Challenge extends Model
{
    public function getAll(): array
    {
        $sql = "
            SELECT *
            FROM challenges
            ORDER BY created_at DESC
        ";

        return $this->db
            ->query($sql)
            ->fetchAll();
    }

    public function findById(int $id): ?array
    {
        $sql = "
            SELECT *
            FROM challenges
            WHERE id = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        $challenge = $stmt->fetch();

        return $challenge ?: null;
    }

    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO challenges
            (
                title,
                description,
                difficulty,
                xp_reward,
                flag
            )
            VALUES
            (
                :title,
                :description,
                :difficulty,
                :xp_reward,
                :flag
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':difficulty' => $data['difficulty'],
            ':xp_reward' => $data['xp_reward'],
            ':flag' => $data['flag']
        ]);
    }

    public function update(
        int $id,
        array $data
    ): bool {

        $sql = "
            UPDATE challenges
            SET
                title = :title,
                description = :description,
                difficulty = :difficulty,
                xp_reward = :xp_reward,
                flag = :flag
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':difficulty' => $data['difficulty'],
            ':xp_reward' => $data['xp_reward'],
            ':flag' => $data['flag'],
            ':id' => $id
        ]);
    }

    public function delete(int $id): bool
    {
        $sql = "
            DELETE FROM challenges
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id
        ]);
    }

public function hasSolved(
    int $userId,
    int $challengeId
): bool {

    $sql = "
        SELECT id
        FROM submissions
        WHERE user_id = :user_id
        AND challenge_id = :challenge_id
        AND is_correct = 1
        LIMIT 1
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':user_id' => $userId,
        ':challenge_id' => $challengeId
    ]);

    return (bool) $stmt->fetch();
}

}