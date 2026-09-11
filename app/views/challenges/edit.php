<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php require_once __DIR__ . '/../layouts/back_button.php'; ?>

<div class="container mt-4">

    <h2>Editar Desafio</h2>

    <?php if (!$challenge): ?>

        <div class="alert alert-danger">
            Desafio não encontrado.
        </div>

    <?php else: ?>

    <form
        method="POST"
        action="<?= BASE_URL ?>/challenges/update">

        <input
            type="hidden"
            name="id"
            value="<?= $challenge['id'] ?>">

        <div class="mb-3">

            <label class="form-label">
                Título
            </label>

            <input
                type="text"
                name="title"
                class="form-control"
                value="<?= htmlspecialchars($challenge['title']) ?>"
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
                required><?= htmlspecialchars($challenge['description']) ?></textarea>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Dificuldade
            </label>

            <select
                name="difficulty"
                class="form-select">

                <option value="Easy"
                    <?= $challenge['difficulty'] === 'Easy' ? 'selected' : '' ?>>
                    Easy
                </option>

                <option value="Medium"
                    <?= $challenge['difficulty'] === 'Medium' ? 'selected' : '' ?>>
                    Medium
                </option>

                <option value="Hard"
                    <?= $challenge['difficulty'] === 'Hard' ? 'selected' : '' ?>>
                    Hard
                </option>

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
                value="<?= $challenge['xp_reward'] ?>"
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
                value="<?= htmlspecialchars($challenge['flag']) ?>"
                required>

        </div>

        <button
            type="submit"
            class="btn btn-primary">

            Salvar Alterações

        </button>

    </form>

    <?php endif; ?>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>