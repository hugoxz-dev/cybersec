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