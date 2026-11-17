<?php
$pageTitle = 'Início';
require_once __DIR__ . '/../layouts/header.php';

// Limiares de nível (espelham a tabela `levels`)
$levels = ['Iniciante' => 0, 'Aprendiz' => 100, 'Analista' => 300, 'Especialista' => 700, 'Elite' => 1500];

$xp = (int) $stats['xp'];
$currentFloor = 0;
$nextName = null;
$nextXp = null;

foreach ($levels as $name => $required) {
    if ($xp >= $required) {
        $currentFloor = $required;
    } else {
        $nextName = $name;
        $nextXp = $required;
        break;
    }
}

$levelPct = $nextXp === null
    ? 100
    : (int) round((($xp - $currentFloor) / max(1, $nextXp - $currentFloor)) * 100);

$firstName = explode(' ', trim(Auth::user()['name'] ?? ''))[0];
?>

<main class="main-content">

    <section class="hero">

        <div>
            <h1 class="hero-greet">Olá,<strong><?= htmlspecialchars($firstName) ?></strong></h1>
            <p class="hero-note">Seu progresso em trilhas, laboratórios e desafios aparece aqui.</p>
        </div>

        <div class="orb" style="--p: <?= $levelPct ?>" role="img"
             aria-label="Nível <?= htmlspecialchars($stats['level']) ?>, <?= $levelPct ?>% até o próximo nível">
            <div class="orb-inner">
                <div class="orb-level"><?= htmlspecialchars($stats['level']) ?></div>
                <div class="orb-xp"><?= number_format($xp, 0, ',', '.') ?> XP</div>
                <div class="orb-next">
                    <?php if ($nextXp !== null): ?>
                        Faltam <?= $nextXp - $xp ?> XP para <?= $nextName ?>
                    <?php else: ?>
                        Nível máximo
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="hero-side">
            <p class="text-secondary m-0">Próximo passo</p>
            <div class="cta-stack">
                <a class="btn btn-primary" href="<?= BASE_URL ?>/paths">Continuar trilha</a>
                <a class="btn btn-ghost" href="<?= BASE_URL ?>/challenges">Resolver um desafio</a>
            </div>
        </div>

    </section>

    <dl class="stat-strip">
        <div>
            <dt>XP acumulado</dt>
            <dd><?= number_format($xp, 0, ',', '.') ?></dd>
        </div>
        <div>
            <dt>Nível atual</dt>
            <dd><?= htmlspecialchars($stats['level']) ?></dd>
        </div>
        <div>
            <dt>Desafios resolvidos</dt>
            <dd><?= (int) $stats['solved'] ?></dd>
        </div>
    </dl>

    <div class="dash-grid">

        <section aria-labelledby="go-title">
            <h2 class="section-title" id="go-title">Estudar</h2>
            <ul class="shortcut-list">
                <li>
                    <a href="<?= BASE_URL ?>/paths">
                        <div><strong>Trilhas</strong><span>Aulas em sequência com quiz no final</span></div>
                        <span class="go" aria-hidden="true">+</span>
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>/labs">
                        <div><strong>Laboratórios</strong><span>Analise logs, tráfego e artefatos reais</span></div>
                        <span class="go" aria-hidden="true">+</span>
                    </a>
                </li>
                <li>
                    <a href="<?= BASE_URL ?>/challenges">
                        <div><strong>Desafios</strong><span>Encontre a flag e ganhe XP</span></div>
                        <span class="go" aria-hidden="true">+</span>
                    </a>
                </li>
            </ul>
        </section>

        <section aria-labelledby="feed-title">
            <h2 class="section-title" id="feed-title">Atividade recente</h2>

            <?php if (empty($activities)): ?>
                <div class="empty">
                    <strong>Nada por aqui ainda</strong>
                    Abra sua primeira aula e sua atividade começa a aparecer nesta lista.
                </div>
            <?php else: ?>
                <ul class="feed">
                    <?php foreach (array_slice($activities, 0, 6) as $activity): ?>
                        <li>
                            <div>
                                <strong><?= htmlspecialchars($activity['action']) ?></strong>
                                <p><?= htmlspecialchars($activity['description']) ?></p>
                            </div>
                            <time datetime="<?= htmlspecialchars($activity['created_at']) ?>">
                                <?= date('d/m H:i', strtotime($activity['created_at'])) ?>
                            </time>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>

    </div>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
