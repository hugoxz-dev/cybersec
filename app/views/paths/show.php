<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<div class="main-content">

<a
href="<?= BASE_URL ?>/paths"
class="btn btn-outline-light mb-3">

    ← Voltar para Trilhas

</a>

<div class="card">

    <div class="card-body">

        <h2>
            <?= htmlspecialchars(
                $path['title']
            ) ?>
        </h2>

        <p class="text-secondary mt-3">

            <?= htmlspecialchars(
                $path['description']
            ) ?>

        </p>

        <hr>

        <h5>
            Progresso da Trilha
        </h5>

        <div class="progress mt-3">

            <div
            class="progress-bar bg-success"
            role="progressbar"
            style="width: <?= $progress ?>%">

                <?= $progress ?>%

            </div>

        </div>

    </div>

</div>

<div class="card mt-4">

    <div class="card-header">

        Aulas Disponíveis

    </div>

    <div class="card-body">

        <?php foreach($lessons as $lesson): ?>

<?php

$completed =
    $progressModel
        ->isLessonCompleted(
            Auth::id(),
            $lesson['id']
        );

$locked = false;

if ($lesson['lesson_order'] > 1) {

    $previousCompleted =
        $progressModel
            ->isLessonCompleted(
                Auth::id(),
                $lessons[
                    $lesson['lesson_order'] - 2
                ]['id']
            );

    $locked =
        !$previousCompleted;
}

?>

<div
class="d-flex
justify-content-between
align-items-center
border-bottom
py-3">

<div>

<?php if($completed): ?>

<span class="text-success">

✔

</span>

<?php elseif($locked): ?>

<span class="text-danger">

🔒

</span>

<?php else: ?>

<span class="text-warning">

📖

</span>

<?php endif; ?>

Aula
<?= $lesson['lesson_order'] ?>

-

<?= htmlspecialchars(
    $lesson['title']
) ?>

</div>

<?php if(!$locked): ?>

<a
href="<?= BASE_URL ?>/lesson?id=<?= $lesson['id'] ?>"
class="btn btn-primary btn-sm">

Abrir Aula

</a>

<?php endif; ?>

</div>

<?php endforeach; ?>

    </div>

</div>

</div>


<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
