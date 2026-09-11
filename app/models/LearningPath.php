<?php

class LearningPath extends Model
{
    public function getAll(): array
    {
        $sql = "
            SELECT *
            FROM learning_paths
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
            FROM learning_paths
            WHERE id = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return $stmt->fetch() ?: null;
    }

    public function getLessons(
        int $pathId
    ): array {

        $sql = "
            SELECT *
            FROM lessons
            WHERE path_id = :path_id
            ORDER BY lesson_order ASC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':path_id' => $pathId
        ]);

        return $stmt->fetchAll();
    }

    public function getProgress(
      int $pathId,
      int $userId
    ): int {

    $lessonModel =
        new Lesson();

    $progressModel =
        new LessonProgress();

    $total =
        $lessonModel->countByPath(
            $pathId
        );

    if ($total === 0) {
        return 0;
    }

    $completed =
        $progressModel
            ->countCompletedByPath(
                $userId,
                $pathId
            );

    return round(
        ($completed / $total) * 100
    );
  }

  public function getLessonsAdmin(
    int $pathId
): array {

    $sql = "
        SELECT *
        FROM lessons
        WHERE path_id = :path_id
        ORDER BY lesson_order ASC
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':path_id' => $pathId
    ]);

    return $stmt->fetchAll();
}

public function createLesson(
    array $data
): bool {

    $sql = "
        INSERT INTO lessons
        (
            path_id,
            title,
            content,
            lesson_order
        )
        VALUES
        (
            :path_id,
            :title,
            :content,
            :lesson_order
        )
    ";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ':path_id' => $data['path_id'],
        ':title' => $data['title'],
        ':content' => $data['content'],
        ':lesson_order' => $data['lesson_order']
    ]);
 }

public function deleteLesson(
    int $id
 ): bool {

    $sql = "
        DELETE FROM lessons
        WHERE id = :id
    ";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ':id' => $id
    ]);
 }


}