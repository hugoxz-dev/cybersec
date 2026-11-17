<?php
/** @var int $status @var string $title @var string $message @var ?Throwable $debug */
require __DIR__ . '/../layouts/header.php';
?>

<main class="main-content">

    <section class="cert-locked" style="padding-block: clamp(48px, 12vw, 120px)">

        <span class="chip sig-xp mb-4">Erro <?= (int) $status ?></span>

        <h1 class="page-title" style="font-size: clamp(2rem, 5vw, 3.2rem)"><?= htmlspecialchars($title) ?></h1>

        <p class="page-lead mx-auto"><?= htmlspecialchars($message) ?></p>

        <a class="btn btn-glow btn-lg mt-4" href="<?= BASE_URL ?>/<?= Auth::check() ? 'dashboard' : 'login' ?>">
            <?= Auth::check() ? 'Voltar ao início' : 'Ir para o login' ?>
        </a>

    </section>

    <?php if (!empty($debug)): ?>
        <div class="terminal mb-5" style="text-align: left">
            <div class="terminal-bar"><i></i><i></i><i></i><span>debug — APP_ENV=development</span></div>
            <pre><?= htmlspecialchars(get_class($debug) . ': ' . $debug->getMessage() . "\n" . $debug->getFile() . ':' . $debug->getLine() . "\n\n" . $debug->getTraceAsString()) ?></pre>
        </div>
    <?php endif; ?>

</main>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
