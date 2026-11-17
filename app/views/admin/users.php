<?php
$pageTitle = 'Usuários';
require_once __DIR__ . '/../layouts/header.php';
?>

<main class="main-content">

    <?php $backHref = BASE_URL . '/admin'; $backLabel = 'Administração'; require __DIR__ . '/../layouts/back_button.php'; ?>

    <header class="page-head">
        <div>
            <h1 class="page-title">Usuários</h1>
            <p class="page-lead"><?= count($users) ?> contas cadastradas.</p>
        </div>
    </header>

    <div class="panel p-0">
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr><th scope="col">ID</th><th scope="col">Nome</th><th scope="col">E-mail</th><th scope="col" class="text-end">XP</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="tile-id"><?= (int) $user['id'] ?></td>
                            <td><?= htmlspecialchars($user['name']) ?></td>
                            <td class="text-secondary"><?= htmlspecialchars($user['email']) ?></td>
                            <td class="text-end xp"><?= (int) $user['xp'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
