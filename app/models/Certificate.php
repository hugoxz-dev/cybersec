<?php

class Certificate extends Model
{
    public function generate(
        int $userId
    ): bool {

        $code = strtoupper(
            uniqid('CYBERSEC-')
        );

        $sql = "
            INSERT INTO certificates
            (
                user_id,
                certificate_code
            )
            VALUES
            (
                :user_id,
                :code
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':user_id' => $userId,
            ':code' => $code
        ]);
    }

    public function findByUser(
        int $userId
    ): ?array {

        $sql = "
            SELECT *
            FROM certificates
            WHERE user_id = :user_id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':user_id' => $userId
        ]);

        $result = $stmt->fetch();

        return $result ?: null;
    }
}