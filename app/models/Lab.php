<?php

class Lab extends Model
{
    public function getAll(): array
    {
        $sql = "
            SELECT *
            FROM labs
            ORDER BY id DESC
        ";

        return $this->db
            ->query($sql)
            ->fetchAll();
    }

    public function findById(
        int $id
    ): ?array {

        $sql = "
            SELECT *
            FROM labs
            WHERE id = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch()
            ?: null;
    }

    public function create(
        array $data
    ): bool {

        $sql = "
            INSERT INTO labs
            (
                title,
                description,
                category,
                difficulty,
                xp_reward,
                material,
                question,
                answer
            )
            VALUES
            (
                :title,
                :description,
                :category,
                :difficulty,
                :xp_reward,
                :material,
                :question,
                :answer
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':title' => $data['title'],
            ':description' => $data['description'],
            ':category' => $data['category'],
            ':difficulty' => $data['difficulty'],
            ':xp_reward' => $data['xp_reward'],
            ':material' => $data['material'],
            ':question' => $data['question'],
            ':answer' => $data['answer']
        ]);
    }

    public function countAll(): int
    {
    $sql = "
        SELECT COUNT(*) total
        FROM labs
    ";

    $result =
        $this->db
            ->query($sql)
            ->fetch();

    return (int)$result['total'];
    }

    public function update(
    int $id,
    array $data
    ): bool {

    $sql = "
        UPDATE labs
        SET
            title = :title,
            description = :description,
            category = :category,
            difficulty = :difficulty,
            xp_reward = :xp_reward,
            material = :material,
            question = :question,
            answer = :answer
        WHERE id = :id
    ";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ':title' => $data['title'],
        ':description' => $data['description'],
        ':category' => $data['category'],
        ':difficulty' => $data['difficulty'],
        ':xp_reward' => $data['xp_reward'],
        ':material' => $data['material'],
        ':question' => $data['question'],
        ':answer' => $data['answer'],
        ':id' => $id
    ]);
    }

    public function delete(
    int $id
    ): bool {

    $sql = "
        DELETE FROM labs
        WHERE id = :id
    ";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ':id' => $id
    ]);
    }

    public function countByCategory(
    string $category
    ): int {

    $sql = "
        SELECT COUNT(*) total
        FROM labs
        WHERE category = :category
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':category' => $category
    ]);

    $result = $stmt->fetch();

    return (int)$result['total'];
    }

    public function getByCategory(
    string $category
    ): array {

    $sql = "
        SELECT *
        FROM labs
        WHERE category = :category
        ORDER BY id DESC
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':category' => $category
    ]);

    return $stmt->fetchAll();
    }

}