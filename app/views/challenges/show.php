<?php
$pageTitle = $challenge['title'];
require_once __DIR__ . '/../layouts/header.php';

$diffLabel = ['Easy' => 'Fácil', 'Medium' => 'Médio', 'Hard' => 'Difícil'][$challenge['difficulty']] ?? $challenge['difficulty'];
$diffSig = match ($challenge['difficulty']) {
    'Easy', 'Fácil' => 'sig-easy',
    'Medium', 'Médio' => 'sig-medium',
    default => 'sig-hard',
};
?>

<main class="main-content">

    <?php $backHref = BASE_URL . '/challenges'; $backLabel = 'Todos os desafios'; require __DIR__ . '/../layouts/back_button.php'; ?>

    <header class="page-head">
        <div>
            <h1 class="page-title"><?= htmlspecialchars($challenge['title']) ?></h1>
            <div class="path-meta">
                <span class="chip chip-dot <?= $diffSig ?>"><?= htmlspecialchars($diffLabel) ?></span>
                <span class="chip sig-xp"><?= (int) $challenge['xp_reward'] ?> XP</span>
            </div>
        </div>
    </header>

    <?php if (Session::get('error')): ?>
        <div class="alert alert-danger mb-4" role="alert"><?= htmlspecialchars((string) Session::get('error')) ?></div>
        <?php Session::remove('error'); ?>
    <?php endif; ?>

    <?php if (Session::get('success')): ?>
        <div class="alert alert-success mb-4" role="status"><?= htmlspecialchars((string) Session::get('success')) ?></div>
        <?php Session::remove('success'); ?>
    <?php endif; ?>

    <div class="split">

        <section aria-labelledby="brief-title">
            <h2 class="section-title" id="brief-title">Enunciado</h2>
            <div class="reading">
                <?= nl2br(htmlspecialchars($challenge['description'])) ?>
            </div>
        </section>

        <aside class="panel">
            <h2 class="section-title">Enviar flag</h2>
            <form method="POST" action="<?= BASE_URL ?>/challenge/submit">
<?= Csrf::field() ?>
                <input type="hidden" name="challenge_id" value="<?= (int) $challenge['id'] ?>">
                <div class="field">
                    <label for="flag">Flag</label>
                    <input id="flag" type="text" name="flag" class="form-control form-control-mono" placeholder="FLAG{...}" autocomplete="off" spellcheck="false" required>
                </div>
                <button type="submit" class="btn btn-glow w-100">Enviar flag</button>
            </form>
        </aside>

    </div>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
