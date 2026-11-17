<?php
$pageTitle = $lesson['title'];
require_once __DIR__ . '/../layouts/header.php';
?>

<main class="main-content">

    <?php $backHref = BASE_URL . '/path?id=' . (int) $lesson['path_id']; $backLabel = 'Voltar para a trilha'; require __DIR__ . '/../layouts/back_button.php'; ?>

    <header class="page-head">
        <div>
            <h1 class="page-title"><?= htmlspecialchars($lesson['title']) ?></h1>
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

    <article class="reading lead-initial">
        <?= nl2br(htmlspecialchars($lesson['content'])) ?>
    </article>

    <?php if (!empty($quiz)): ?>
    <section class="mt-5 pt-4" aria-labelledby="quiz-title" style="max-width: 900px">
        <h2 class="section-title" id="quiz-title">Quiz da aula</h2>
        <p class="text-secondary mb-4">Responda todas as perguntas para concluir a aula e liberar a próxima.</p>

        <form method="POST" action="<?= BASE_URL ?>/lesson/submit">
<?= Csrf::field() ?>
            <input type="hidden" name="lesson_id" value="<?= (int) $lesson['id'] ?>">

            <?php foreach ($quiz as $i => $question): ?>
                <fieldset class="quiz-q">
                    <legend><span><?= $i + 1 ?></span><?= htmlspecialchars($question['question']) ?></legend>
                    <div class="options">
                        <?php foreach (['A', 'B', 'C', 'D'] as $k => $letter): ?>
                            <label class="option">
                                <input type="radio" name="question_<?= (int) $question['id'] ?>" value="<?= $letter ?>" <?= $k === 0 ? 'required' : '' ?>>
                                <span class="key"><?= $letter ?></span>
                                <?= htmlspecialchars($question['option_' . strtolower($letter)]) ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </fieldset>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-glow btn-lg mt-3">Enviar respostas</button>
        </form>
    </section>
    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
