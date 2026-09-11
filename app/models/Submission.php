<?php

class Submission extends Model
{
    public function create(
        int $userId,
        int $challengeId,
        string $flag,
        bool $correct
    ): bool {

        $sql = "
            INSERT INTO submissions
            (
                user_id,
                challenge_id,
                submitted_flag,
                is_correct
            )
            VALUES
            (
                :user_id,
                :challenge_id,
                :submitted_flag,
                :is_correct
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':user_id' => $userId,
            ':challenge_id' => $challengeId,
            ':submitted_flag' => $flag,
            ':is_correct' => $correct ? 1 : 0
        ]);
    }
}