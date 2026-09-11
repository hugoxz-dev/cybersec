<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php require_once __DIR__ . '/../layouts/back_button.php'; ?>

<div class="container mt-4">

    <h2>Novo Desafio</h2>

    <form
        method="POST"
        action="<?= BASE_URL ?>/challenges/store">

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