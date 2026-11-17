<?php
$pageTitle = 'Certificado';
require_once __DIR__ . '/../layouts/header.php';

$required = 5;
$solved = (int) (new User())->countSolvedChallenges(Auth::id());
$certPct = (int) min(100, round(($solved / $required) * 100));
?>

<main class="main-content">

    <?php if (Session::has('error')): ?>
        <div class="alert alert-danger mt-4" role="alert"><?= htmlspecialchars((string) Session::get('error')) ?></div>
        <?php Session::remove('error'); ?>
    <?php endif; ?>

    <?php if (Session::has('success')): ?>
        <div class="alert alert-success mt-4" role="status"><?= htmlspecialchars((string) Session::get('success')) ?></div>
        <?php Session::remove('success'); ?>
    <?php endif; ?>

    <?php if (!$certificate): ?>

        <section class="cert-locked" style="padding-block: clamp(32px, 8vw, 88px)">
            <div class="orb" style="--p: <?= $certPct ?>" role="img" aria-label="<?= min($solved, $required) ?> de <?= $required ?> desafios resolvidos">
                <div class="orb-inner">
                    <div class="orb-level"><?= min($solved, $required) ?>/<?= $required ?></div>
                    <div class="orb-next">desafios resolvidos</div>
                </div>
            </div>

            <h1 class="page-title" style="font-size: clamp(2rem, 5vw, 3.2rem)">Seu certificado</h1>

            <?php if ($solved >= $required): ?>
                <p class="page-lead mx-auto">Você já resolveu <?= $required ?> desafios. Gere o certificado com seu código de verificação.</p>
                <form method="POST" action="<?= BASE_URL ?>/certificate/generate" class="mt-4">
<?= Csrf::field() ?>
                    <button class="btn btn-glow btn-lg" type="submit">Gerar certificado</button>
                </form>
            <?php else: ?>
                <p class="page-lead mx-auto">Resolva <?= $required ?> desafios para liberar o certificado. Faltam <?= $required - $solved ?>.</p>
                <a class="btn btn-primary btn-lg mt-4" href="<?= BASE_URL ?>/challenges">Ir para os desafios</a>
            <?php endif; ?>
        </section>

    <?php else: ?>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4 mt-2">
            <?php require __DIR__ . '/../layouts/back_button.php'; ?>
        </div>

        <article class="certificate" aria-label="Certificado de conclusão">
            <span class="brand"><span class="brand-mark" aria-hidden="true"></span>CYBERSEC</span>

            <p class="cert-kicker">Certificado de conclusão concedido a</p>

            <h1 class="cert-name"><?= htmlspecialchars(Auth::user()['name']) ?></h1>

            <p class="cert-text">por cumprir os requisitos da plataforma CyberSec, resolvendo desafios práticos de segurança da informação.</p>

            <dl class="cert-foot">
                <div>
                    <dt>Código de verificação</dt>
                    <dd><?= htmlspecialchars($certificate['certificate_code']) ?></dd>
                </div>
                <div>
                    <dt>Emitido em</dt>
                    <dd><?= date('d/m/Y', strtotime($certificate['issued_at'])) ?></dd>
                </div>
            </dl>
        </article>

    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
