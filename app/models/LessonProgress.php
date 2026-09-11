<?php

class LessonProgress extends Model
{
    public function complete(
        int $userId,
        int $lessonId
    ): bool {

        $sql = "
            INSERT INTO lesson_progress
            (
                user_id,
                lesson_id,
                completed,
                completed_at
            )
            VALUES
            (
                :user_id,
                :lesson_id,
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
            ':lesson_id' => $lessonId
        ]);
    }

    public function isCompleted(
        int $userId,
        int $lessonId
    ): bool {

        $sql = "
            SELECT id
            FROM lesson_progress
            WHERE user_id = :user_id
            AND lesson_id = :lesson_id
            AND completed = 1
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':user_id' => $userId,
            ':lesson_id' => $lessonId
        ]);

        return (bool)$stmt->fetch();
    }

    public function countCompletedByPath(
    int $userId,
    int $pathId
 ): int {

    $sql = "
        SELECT COUNT(lp.id) total
        FROM lesson_progress lp
        INNER JOIN lessons l
            ON l.id = lp.lesson_id
        WHERE lp.user_id = :user_id
        AND lp.completed = 1
        AND l.path_id = :path_id
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':user_id' => $userId,
        ':path_id' => $pathId
    ]);

    $result = $stmt->fetch();

    return (int)$result['total'];
}

 public function isLessonCompleted(
    int $userId,
    int $lessonId
 ): bool {

    return $this->isCompleted(
        $userId,
        $lessonId
    );
 }

}