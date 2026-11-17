<?php
$pageTitle = $lab['title'];
require_once __DIR__ . '/../layouts/header.php';
?>

<main class="main-content">

    <?php $backHref = BASE_URL . '/labs'; $backLabel = 'Todos os laboratórios'; require __DIR__ . '/../layouts/back_button.php'; ?>

    <header class="page-head">
        <div>
            <h1 class="page-title"><?= htmlspecialchars($lab['title']) ?></h1>
            <p class="page-lead"><?= htmlspecialchars($lab['description']) ?></p>
        </div>
    </header>

    <?php if (Session::has('success')): ?>
        <div class="alert alert-success mb-4" role="status"><?= htmlspecialchars((string) Session::get('success')) ?></div>
        <?php Session::remove('success'); ?>
    <?php endif; ?>

    <?php if (Session::has('error')): ?>
        <div class="alert alert-danger mb-4" role="alert"><?= htmlspecialchars((string) Session::get('error')) ?></div>
        <?php Session::remove('error'); ?>
    <?php endif; ?>

    <div class="split">

        <section aria-labelledby="material-title">
            <h2 class="section-title" id="material-title">Material de análise</h2>
            <div class="terminal">
                <div class="terminal-bar"><i></i><i></i><i></i><span><?= htmlspecialchars($lab['category'] ?? 'evidência') ?></span></div>
                <pre><?= htmlspecialchars($lab['material']) ?></pre>
            </div>
        </section>

        <aside class="panel">
            <h2 class="section-title">Pergunta</h2>
            <p class="mb-4"><?= htmlspecialchars($lab['question']) ?></p>

            <form method="POST" action="<?= BASE_URL ?>/lab/submit">
<?= Csrf::field() ?>
                <input type="hidden" name="lab_id" value="<?= (int) $lab['id'] ?>">
                <div class="field">
                    <label for="answer">Sua resposta</label>
                    <input id="answer" type="text" name="answer" class="form-control form-control-mono" autocomplete="off" spellcheck="false" required>
                </div>
                <button type="submit" class="btn btn-glow w-100">Enviar resposta</button>
            </form>

            <dl class="facts mt-4">
                <?php if (!empty($lab['difficulty'])): ?>
                    <div><dt>Dificuldade</dt><dd><?= htmlspecialchars($lab['difficulty']) ?></dd></div>
                <?php endif; ?>
                <div><dt>Recompensa</dt><dd class="xp"><?= (int) ($lab['xp_reward'] ?? 0) ?> XP</dd></div>
            </dl>
        </aside>

    </div>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
