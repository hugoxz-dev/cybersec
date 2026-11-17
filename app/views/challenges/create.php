<?php require_once __DIR__ . '/../layouts/header.php'; ?>


<div class="container mt-4">

<?php $backHref = BASE_URL . "/challenges"; $backLabel = "Todos os desafios"; require __DIR__ . "/../layouts/back_button.php"; ?>

    <h2>Novo Desafio</h2>

    <?php if (Session::has('error')): ?>
        <div class="alert alert-danger mb-4" role="alert"><?= htmlspecialchars((string) Session::get('error')) ?></div>
        <?php Session::remove('error'); ?>
    <?php endif; ?>

    <form
        method="POST"
        action="<?= BASE_URL ?>/challenges/store">
<?= Csrf::field() ?>

        <div class="mb-3">

            <label class="form-label">
                Título
            </label>

            <input
                type="text"
                name="title"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Descrição
            </label>

            <textarea
                name="description"
                class="form-control"
                rows="5"
                required></textarea>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Dificuldade
            </label>

            <select
                name="difficulty"
                class="form-select">

                <option value="Easy">Easy</option>
                <option value="Medium">Medium</option>
                <option value="Hard">Hard</option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">
                XP
            </label>

            <input
                type="number"
                name="xp_reward"
                class="form-control"
                required>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Flag
            </label>

            <input
                type="text"
                name="flag"
                class="form-control"
                required>

        </div>

        <button
            type="submit"
            class="btn btn-success">

            Criar Desafio

        </button>

    </form>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>