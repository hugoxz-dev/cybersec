<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<div class="main-content">

<a
href="<?= BASE_URL ?>/path?id=<?= $lesson['path_id'] ?>"
class="btn btn-outline-secondary mb-4">

← Voltar para Trilha

</a>

<?php if(Session::has('success')): ?>

<div class="alert alert-success">

<?= Session::get('success'); ?>

</div>

<?php Session::remove('success'); ?>

<?php endif; ?>

<?php if(Session::has('error')): ?>

<div class="alert alert-danger">

<?= Session::get('error'); ?>

</div>

<?php Session::remove('error'); ?>

<?php endif; ?>
<div class="card">

    <div class="card-body">

        <h2>
            <?= htmlspecialchars(
                $lesson['title']
            ) ?>
        </h2>

        <hr>

        <div>
            <?= nl2br(
                htmlspecialchars(
                    $lesson['content']
                )
            ) ?>
        </div>

    </div>

</div>

<h3 class="mt-4">
    Quiz
</h3>

<form
    method="POST"
    action="<?= BASE_URL ?>/lesson/submit">

    <input
        type="hidden"
        name="lesson_id"
        value="<?= $lesson['id'] ?>">

    <?php foreach($quiz as $question): ?>

    <div class="card mt-3">

        <div class="card-body">

            <p>
                <strong>
                    <?= htmlspecialchars(
                        $question['question']
                    ) ?>
                </strong>
            </p>

            <div class="mb-2">

                <label>

                    <input
                        type="radio"
                        name="question_<?= $question['id'] ?>"
                        value="A"
                        required>

                    A)
                    <?= htmlspecialchars(
                        $question['option_a']
                    ) ?>

                </label>

            </div>

            <div class="mb-2">

                <label>

                    <input
                        type="radio"
                        name="question_<?= $question['id'] ?>"
                        value="B">

                    B)
                    <?= htmlspecialchars(
                        $question['option_b']
                    ) ?>

                </label>

            </div>

            <div class="mb-2">

                <label>

                    <input
                        type="radio"
                        name="question_<?= $question['id'] ?>"
                        value="C">

                    C)
                    <?= htmlspecialchars(
                        $question['option_c']
                    ) ?>

                </label>

            </div>

            <div class="mb-2">

                <label>

                    <input
                        type="radio"
                        name="question_<?= $question['id'] ?>"
                        value="D">

                    D)
                    <?= htmlspecialchars(
                        $question['option_d']
                    ) ?>

                </label>

            </div>

        </div>

    </div>

    <?php endforeach; ?>

    <button
        type="submit"
        class="btn btn-success mt-4">

        Enviar Respostas

    </button>

</form>

</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>
