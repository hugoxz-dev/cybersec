<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<div class="main-content">

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">

            🧪 Laboratórios

        </h2>

        <p class="text-secondary">

            Pratique conceitos reais de cibersegurança.

        </p>

    </div>

</div>

<div class="alert alert-info">

    Laboratórios concluídos:

    <strong>

        <?= $completedLabs ?>

        /

        <?= $totalLabs ?>

    </strong>

</div>

<div class="mb-4">

<a
href="<?= BASE_URL ?>/labs"
class="btn btn-outline-light btn-sm">

Todos

</a>

<a
href="<?= BASE_URL ?>/labs?category=Web Security"
class="btn btn-outline-info btn-sm">

🌐 Web

</a>

<a
href="<?= BASE_URL ?>/labs?category=Linux"
class="btn btn-outline-success btn-sm">

🐧 Linux

</a>

<a
href="<?= BASE_URL ?>/labs?category=Redes"
class="btn btn-outline-primary btn-sm">

🌍 Redes

</a>

<a
href="<?= BASE_URL ?>/labs?category=OSINT"
class="btn btn-outline-warning btn-sm">

📦 OSINT

</a>

<a
href="<?= BASE_URL ?>/labs?category=Forense"
class="btn btn-outline-danger btn-sm">

🔍 Forense

</a>

<a
href="<?= BASE_URL ?>/labs?category=Logs"
class="btn btn-outline-secondary btn-sm">

📜 Logs

</a>

</div>

<div class="row">

<?php foreach($labs as $lab): ?>

    <?php

$isCompleted =
    $progressModel
        ->isCompleted(
            Auth::id(),
            $lab['id']
        );

?>

<div class="col-lg-4 col-md-6 mb-4">

    <div class="card challenge-card h-100">

        <div class="card-body d-flex flex-column">

            <div class="mb-3">

                <?php

$badge = match($lab['category']) {

    'Web Security' =>
        'bg-info',

    'Linux' =>
        'bg-success',

    'Redes' =>
        'bg-primary',

    'OSINT' =>
        'bg-warning text-dark',

    'Forense' =>
        'bg-danger',

    'Logs' =>
        'bg-secondary',

    'Criptografia' =>
        'bg-dark',

    'SQL Injection' =>
        'bg-danger',

    default =>
        'bg-light text-dark'
};

?>

<span class="badge <?= $badge ?>">

    <?= htmlspecialchars(
        $lab['category']
    ) ?>

</span>

            </div>

            <h4>

                <?= htmlspecialchars(
                    $lab['title']
                ) ?>

            </h4>

            <p class="text-secondary flex-grow-1">

                <?= htmlspecialchars(
                    $lab['description']
                ) ?>

            </p>

            <div class="mb-3">

                <span class="badge bg-warning text-dark">

                    <?= htmlspecialchars(
                        $lab['difficulty']
                    ) ?>

                </span>

            </div>

            <?php if($isCompleted): ?>

             <span class="badge bg-success">

                  ✔ Concluído

             </span>

            <?php else: ?>

             <span class="badge bg-warning text-dark">

              Disponível

             </span>

             <?php endif; ?>

            <div class="mb-3">

                <strong>

                    <?= $lab['xp_reward'] ?>

                    XP

                </strong>

            </div>

            <a
            href="<?= BASE_URL ?>/lab?id=<?= $lab['id'] ?>"
            class="btn btn-primary w-100">

                Abrir Laboratório

            </a>

        </div>

    </div>

</div>

<?php endforeach; ?>

</div>

</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>