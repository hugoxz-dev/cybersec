<?php
$pageTitle = $path['title'];
require_once __DIR__ . '/../layouts/header.php';

$progress = (int) $progress;

// Estado de cada aula: concluída, atual ou bloqueada
$rows = [];
$prevDone = true;
$currentMarked = false;
foreach ($lessons as $index => $lesson) {
    $done = $progressModel->isLessonCompleted(Auth::id(), $lesson['id']);
    $locked = $index > 0 && !$prevDone;
    $state = $done ? 'done' : ($locked ? 'locked' : 'open');
    if ($state === 'open' && !$currentMarked) {
        $state = 'current';
        $currentMarked = true;
    }
    $rows[] = [$lesson, $state];
    $prevDone = $done;
}
?>

<main class="main-content">

    <?php $backHref = BASE_URL . '/paths'; $backLabel = 'Todas as trilhas'; require __DIR__ . '/../layouts/back_button.php'; ?>

    <header class="page-head">
        <div>
            <h1 class="page-title"><?= htmlspecialchars($path['title']) ?></h1>
            <p class="page-lead"><?= htmlspecialchars($path['description']) ?></p>
        </div>
        <div class="page-head-aside">
            <div style="width: min(100%, 280px)">
                <small class="text-secondary d-block mb-2">Progresso da trilha</small>
                <div class="meter">
                    <div class="progress" role="progressbar" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Progresso da trilha">
                        <div class="progress-bar" style="width: <?= $progress ?>%"></div>
                    </div>
                    <span class="meter-value"><?= $progress ?>%</span>
                </div>
            </div>
        </div>
    </header>

    <h2 class="section-title">Aulas</h2>

    <?php if (empty($rows)): ?>
        <div class="empty"><strong>Esta trilha ainda não tem aulas</strong>Volte em breve.</div>
    <?php else: ?>
    <ol class="timeline">
        <?php foreach ($rows as [$lesson, $state]): ?>
            <li class="is-<?= $state ?>">
                <span class="step" aria-hidden="true"><?= $state === 'done' ? '✓' : (int) $lesson['lesson_order'] ?></span>
                <div>
                    <h4><?= htmlspecialchars($lesson['title']) ?></h4>
                    <span class="state">
                        <?= ['done' => 'Concluída', 'current' => 'Próxima aula', 'open' => 'Disponível', 'locked' => 'Conclua a aula anterior para liberar'][$state] ?>
                    </span>
                </div>
                <?php if ($state !== 'locked'): ?>
                    <a href="<?= BASE_URL ?>/lesson?id=<?= (int) $lesson['id'] ?>"
                       class="btn btn-sm <?= $state === 'current' ? 'btn-primary' : 'btn-ghost' ?>">
                        <?= $state === 'done' ? 'Revisar' : 'Abrir aula' ?>
                    </a>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
