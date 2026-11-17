<?php
$pageTitle = 'Trilhas';
require_once __DIR__ . '/../layouts/header.php';

$learningPath = new LearningPath();
$diffClass = [
    'iniciante' => 'sig-easy',
    'intermediario' => 'sig-medium',
    'intermediário' => 'sig-medium',
    'avancado' => 'sig-hard',
    'avançado' => 'sig-hard',
];
?>

<main class="main-content">

    <header class="page-head">
        <div>
            <h1 class="page-title">Trilhas de<br>aprendizagem</h1>
            <p class="page-lead">Cada trilha é uma sequência de aulas. Conclua o quiz de uma aula para liberar a próxima.</p>
        </div>
    </header>

    <?php if (empty($paths)): ?>
        <div class="empty"><strong>Nenhuma trilha publicada</strong>As trilhas aparecem aqui assim que forem criadas na área administrativa.</div>
    <?php else: ?>
    <ul class="path-list">
        <?php foreach ($paths as $path): ?>
            <?php
            $progress = (int) $learningPath->getProgress($path['id'], Auth::id());
            $lessonCount = count($learningPath->getLessons($path['id']));
            $difficulty = mb_strtolower($path['difficulty'] ?? 'iniciante');
            ?>
            <li class="path-row">
                <div>
                    <h3><?= htmlspecialchars($path['title']) ?></h3>
                    <p><?= htmlspecialchars($path['description']) ?></p>
                    <div class="path-meta">
                        <span class="chip chip-dot <?= $diffClass[$difficulty] ?? 'sig-open' ?>"><?= htmlspecialchars(mb_convert_case($difficulty, MB_CASE_TITLE)) ?></span>
                        <span class="chip"><?= $lessonCount ?> <?= $lessonCount === 1 ? 'aula' : 'aulas' ?></span>
                        <span class="chip sig-xp"><?= (int) $path['xp_reward'] ?> XP</span>
                    </div>
                </div>

                <div class="path-progress">
                    <small><?= $progress >= 100 ? 'Trilha concluída' : ($progress > 0 ? 'Em andamento' : 'Não iniciada') ?></small>
                    <div class="meter">
                        <div class="progress" role="progressbar" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Progresso da trilha">
                            <div class="progress-bar" style="width: <?= $progress ?>%"></div>
                        </div>
                        <span class="meter-value"><?= $progress ?>%</span>
                    </div>
                </div>

                <a href="<?= BASE_URL ?>/path?id=<?= (int) $path['id'] ?>" class="btn <?= $progress > 0 ? 'btn-primary' : 'btn-ghost' ?>">
                    <?= $progress >= 100 ? 'Revisar trilha' : ($progress > 0 ? 'Continuar trilha' : 'Iniciar trilha') ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
