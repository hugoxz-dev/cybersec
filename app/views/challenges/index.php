<?php
$pageTitle = 'Desafios';
require_once __DIR__ . '/../layouts/header.php';

$model = new Challenge();
$solvedMap = [];
foreach ($challenges as $c) {
    $solvedMap[$c['id']] = $model->hasSolved(Auth::id(), $c['id']);
}

$totalChallenges = count($challenges);
$solvedCount = count(array_filter($solvedMap));
$progress = $totalChallenges > 0 ? (int) round(($solvedCount / $totalChallenges) * 100) : 0;

$diffSig = static fn(string $d): string => match ($d) {
    'Easy', 'Fácil' => 'sig-easy',
    'Medium', 'Médio' => 'sig-medium',
    default => 'sig-hard',
};
$diffLabel = static fn(string $d): string => ['Easy' => 'Fácil', 'Medium' => 'Médio', 'Hard' => 'Difícil'][$d] ?? $d;
?>

<main class="main-content">

    <header class="page-head">
        <div>
            <h1 class="page-title">Desafios</h1>
            <p class="page-lead">Cada desafio esconde uma flag. Encontre, envie e ganhe o XP do desafio.</p>
        </div>
        <?php if (Auth::isAdmin()): ?>
            <div class="page-head-aside">
                <a href="<?= BASE_URL ?>/challenges/create" class="btn btn-primary">Novo desafio</a>
            </div>
        <?php endif; ?>
    </header>

    <?php if (Session::has('success')): ?>
        <div class="alert alert-success mb-4" role="status"><?= htmlspecialchars((string) Session::get('success')) ?></div>
        <?php Session::remove('success'); ?>
    <?php endif; ?>

    <div class="summary-bar">
        <div class="summary-count"><?= $solvedCount ?>/<?= $totalChallenges ?><small>resolvidos</small></div>
        <div class="meter">
            <div class="progress" role="progressbar" aria-valuenow="<?= $progress ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Desafios resolvidos">
                <div class="progress-bar" style="width: <?= $progress ?>%"></div>
            </div>
            <span class="meter-value"><?= $progress ?>%</span>
        </div>
    </div>

    <?php if (empty($challenges)): ?>
        <div class="empty"><strong>Nenhum desafio publicado</strong>Novos desafios aparecem aqui assim que forem criados.</div>
    <?php else: ?>
    <div class="tile-grid">
        <?php foreach ($challenges as $challenge): ?>
            <?php $solved = $solvedMap[$challenge['id']]; ?>
            <article class="tile <?= $solved ? 'is-done' : '' ?>">
                <div class="tile-top">
                    <span class="chip chip-dot <?= $diffSig($challenge['difficulty']) ?>"><?= htmlspecialchars($diffLabel($challenge['difficulty'])) ?></span>
                    <span class="tile-id">#<?= str_pad((string) $challenge['id'], 3, '0', STR_PAD_LEFT) ?></span>
                </div>

                <h3><?= htmlspecialchars($challenge['title']) ?></h3>
                <p><?= $solved ? 'Flag encontrada.' : 'Flag ainda não encontrada.' ?></p>

                <div class="tile-foot">
                    <span class="xp"><?= (int) $challenge['xp_reward'] ?> XP</span>
                    <a href="<?= BASE_URL ?>/challenge?id=<?= (int) $challenge['id'] ?>" class="btn btn-sm <?= $solved ? 'btn-ghost' : 'btn-primary' ?>">
                        <?= $solved ? 'Revisar' : 'Resolver' ?>
                    </a>
                </div>

                <?php if (Auth::isAdmin()): ?>
                    <div class="tile-admin">
                        <a href="<?= BASE_URL ?>/challenges/edit?id=<?= (int) $challenge['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <form method="POST" action="<?= BASE_URL ?>/challenges/delete">
<?= Csrf::field() ?>
                            <input type="hidden" name="id" value="<?= (int) $challenge['id'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Excluir este desafio?');">Excluir</button>
                        </form>
                    </div>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
