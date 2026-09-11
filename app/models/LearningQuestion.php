<?php

class LearningQuestion extends Model
{
    public function getByLesson(
        int $lessonId
    ): array {

        $sql = "
            SELECT *
            FROM quizzes
            WHERE lesson_id = :lesson_id
            ORDER BY id ASC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':lesson_id' => $lessonId
        ]);

        return $stmt->fetchAll();
    }

    public function create(
      array $data
  ):  bool {

    $sql = "
        INSERT INTO quizzes
        (
            lesson_id,
            question,
            option_a,
            option_b,
            option_c,
            option_d,
            correct_option
        )
        VALUES
        (
            :lesson_id,
            :question,
            :option_a,
            :option_b,
            :option_c,
            :option_d,
            :correct_option
        )
    ";

    $stmt = $this->db->prepare($sql);

    return $stmt->execute($data);
  }

  public function findById(
    int $id
 ): ?array {

    $sql = "
        SELECT *
        FROM quizzes
        WHERE id = :id
        LIMIT 1
    ";

    $stmt = $this->db->prepare($sql);

    $stmt->execute([
        ':id' => $id
    ]);

    return $stmt->fetch() ?: null;
 }

 public function update(
    int $id,
    array $data
 ): bool {

    $sql = "
        UPDATE quizzes
        SET
            question = :question,
            option_a = :option_a,
            option_b = :option_b,
            option_c = :option_c,
            option_d = :option_d,
            correct_option = :correct_option
        WHERE id = :id
    ";

    $stmt = $this->db->prepare($sql);

    $data['id'] = $id;

    return $stmt->execute($data);
  }

}