-- Migração 001 — endurecimento de segurança (2026-11-16)
-- Aplicar com: mysql -uroot cybersec < database/migrations/001_security_hardening.sql

-- Uma linha por desafio resolvido. A chave única impede XP em dobro
-- quando a mesma flag correta é enviada duas vezes ao mesmo tempo.
CREATE TABLE IF NOT EXISTS `challenge_solves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `solved_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_solve_user_challenge` (`user_id`, `challenge_id`),
  KEY `fk_solve_challenge` (`challenge_id`),
  CONSTRAINT `fk_solve_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_solve_challenge` FOREIGN KEY (`challenge_id`) REFERENCES `challenges` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Preenche com as soluções que já existem em submissions.
INSERT IGNORE INTO `challenge_solves` (`user_id`, `challenge_id`, `solved_at`)
SELECT `user_id`, `challenge_id`, MIN(`created_at`)
FROM `submissions`
WHERE `is_correct` = 1
GROUP BY `user_id`, `challenge_id`;

-- Tentativas registradas para limitar força bruta (login, flags, labs).
CREATE TABLE IF NOT EXISTS `attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scope` varchar(32) NOT NULL,
  `identifier` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_attempts_lookup` (`scope`, `identifier`, `created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
