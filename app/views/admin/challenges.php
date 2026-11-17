<?php
$pageTitle = 'Desafios';
require_once __DIR__ . '/../layouts/header.php';
?>

<main class="main-content">

    <?php $backHref = BASE_URL . '/admin'; $backLabel = 'Administração'; require __DIR__ . '/../layouts/back_button.php'; ?>

    <header class="page-head">
        <div>
            <h1 class="page-title">Desafios</h1>
            <p class="page-lead"><?= count($challenges) ?> desafios publicados.</p>
        </div>
        <div class="page-head-aside">
            <a href="<?= BASE_URL ?>/challenges/create" class="btn btn-primary">Novo desafio</a>
        </div>
    </header>

    <div class="panel p-0">
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr><th scope="col">ID</th><th scope="col">Título</th><th scope="col">Dificuldade</th><th scope="col" class="text-end">XP</th><th scope="col" class="text-end">Ações</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($challenges as $challenge): ?>
                        <tr>
                            <td class="tile-id"><?= (int) $challenge['id'] ?></td>
                            <td><?= htmlspecialchars($challenge['title']) ?></td>
                            <td class="text-secondary"><?= htmlspecialchars($challenge['difficulty']) ?></td>
                            <td class="text-end xp"><?= (int) $challenge['xp_reward'] ?></td>
                            <td class="text-end"><a href="<?= BASE_URL ?>/challenges/edit?id=<?= (int) $challenge['id'] ?>" class="btn btn-ghost btn-sm">Editar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
