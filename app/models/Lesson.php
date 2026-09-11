<?php

class Lesson extends Model
{
    public function findById(
        int $id
    ): ?array {

        $sql = "
            SELECT *
            FROM lessons
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

    public function getQuiz(
        int $lessonId
    ): array {

        $sql = "
            SELECT *
            FROM quizzes
            WHERE lesson_id = :lesson_id
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':lesson_id' => $lessonId
        ]);

        return $stmt->fetchAll();
    }

    public function countByPath(
    int $pathId
    ): int {

    $sql = "
        SELECT COUNT(*) total
        FROM lessons
        WHERE path_id = :path_id
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':path_id' => $pathId
    ]);

    $result = $stmt->fetch();

    return (int)$result['total'];
    }

    public function getPreviousLesson(
    int $pathId,
    int $lessonOrder
 ): ?array {

    $sql = "
        SELECT *
        FROM lessons
        WHERE path_id = :path_id
        AND lesson_order < :lesson_order
        ORDER BY lesson_order DESC
        LIMIT 1
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':path_id' => $pathId,
        ':lesson_order' => $lessonOrder
    ]);

    return $stmt->fetch() ?: null;
 }

}