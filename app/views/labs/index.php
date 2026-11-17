<?php
$pageTitle = 'Laboratórios';
require_once __DIR__ . '/../layouts/header.php';

$activeCategory = $_GET['category'] ?? '';
$categories = [
    '' => 'Todos',
    'Web Security' => 'Web',
    'Linux' => 'Linux',
    'Redes' => 'Redes',
    'OSINT' => 'OSINT',
    'Forense' => 'Forense',
    'Logs' => 'Logs',
];

$diffSig = static function (string $d): string {
    $d = mb_strtolower($d);
    if (in_array($d, ['easy', 'fácil', 'facil', 'iniciante'], true)) return 'sig-easy';
    if (in_array($d, ['medium', 'médio', 'medio', 'intermediário', 'intermediario'], true)) return 'sig-medium';
    return 'sig-hard';
};

$labPct = $totalLabs > 0 ? (int) round(($completedLabs / $totalLabs) * 100) : 0;
?>

<main class="main-content">

    <header class="page-head">
        <div>
            <h1 class="page-title">Laboratórios</h1>
            <p class="page-lead">Analise material de casos reais — logs, capturas de rede, artefatos — e responda à pergunta de cada lab.</p>
        </div>
    </header>

    <div class="summary-bar">
        <div class="summary-count"><?= (int) $completedLabs ?>/<?= (int) $totalLabs ?><small>concluídos</small></div>
        <div class="meter">
            <div class="progress" role="progressbar" aria-valuenow="<?= $labPct ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Laboratórios concluídos">
                <div class="progress-bar" style="width: <?= $labPct ?>%"></div>
            </div>
            <span class="meter-value"><?= $labPct ?>%</span>
        </div>
    </div>

    <nav class="filter-row" aria-label="Filtrar por categoria">
        <?php foreach ($categories as $value => $label): ?>
            <a href="<?= BASE_URL ?>/labs<?= $value !== '' ? '?category=' . urlencode($value) : '' ?>"
               class="<?= $activeCategory === $value ? 'active' : '' ?>"
               <?= $activeCategory === $value ? 'aria-current="true"' : '' ?>><?= $label ?></a>
        <?php endforeach; ?>
    </nav>

    <?php if (empty($labs)): ?>
        <div class="empty"><strong>Nenhum laboratório nesta categoria</strong>Escolha outra categoria ou veja todos.</div>
    <?php else: ?>
    <div class="tile-grid">
        <?php foreach ($labs as $lab): ?>
            <?php $isCompleted = $progressModel->isCompleted(Auth::id(), $lab['id']); ?>
            <article class="tile <?= $isCompleted ? 'is-done' : '' ?>">
                <div class="tile-top">
                    <span class="chip"><?= htmlspecialchars($lab['category']) ?></span>
                    <span class="chip chip-dot <?= $diffSig((string) $lab['difficulty']) ?>"><?= htmlspecialchars($lab['difficulty']) ?></span>
                </div>
                <h3><?= htmlspecialchars($lab['title']) ?></h3>
                <p><?= htmlspecialchars($lab['description']) ?></p>
                <div class="tile-foot">
                    <span class="xp"><?= (int) $lab['xp_reward'] ?> XP</span>
                    <a href="<?= BASE_URL ?>/lab?id=<?= (int) $lab['id'] ?>" class="btn btn-sm <?= $isCompleted ? 'btn-ghost' : 'btn-primary' ?>">
                        <?= $isCompleted ? 'Revisar lab' : 'Abrir lab' ?>
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
