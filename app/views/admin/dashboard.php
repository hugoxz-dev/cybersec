<?php
$pageTitle = 'Admin';
require_once __DIR__ . '/../layouts/header.php';
?>

<main class="main-content">

    <header class="page-head">
        <div>
            <h1 class="page-title">Administração</h1>
            <p class="page-lead">Visão geral da plataforma e atalhos para gerenciar conteúdo.</p>
        </div>
    </header>

    <dl class="admin-stats">
        <div><dt>Usuários</dt><dd><?= (int) $stats['users'] ?></dd></div>
        <div><dt>Desafios</dt><dd><?= (int) $stats['challenges'] ?></dd></div>
        <div><dt>Submissões</dt><dd><?= (int) $stats['submissions'] ?></dd></div>
        <div><dt>Acertos</dt><dd><?= (int) $stats['correct'] ?></dd></div>
        <div><dt>Taxa de acerto</dt><dd><?= htmlspecialchars((string) $stats['accuracy']) ?>%</dd></div>
    </dl>

    <h2 class="section-title">Gerenciar</h2>
    <nav class="admin-links" aria-label="Gerenciar conteúdo">
        <a href="<?= BASE_URL ?>/admin/paths">Trilhas e aulas</a>
        <a href="<?= BASE_URL ?>/admin/labs">Laboratórios</a>
        <a href="<?= BASE_URL ?>/admin/challenges">Desafios</a>
        <a href="<?= BASE_URL ?>/admin/users">Usuários</a>
    </nav>

    <div class="row g-4">
        <div class="col-lg-7">
            <section class="panel p-0 h-100" aria-labelledby="recent-users">
                <h2 class="section-title px-4 pt-4" id="recent-users">Últimos cadastros</h2>
                <div class="table-wrap">
                    <table class="table">
                        <thead><tr><th scope="col">Nome</th><th scope="col">E-mail</th><th scope="col" class="text-end">Cadastro</th></tr></thead>
                        <tbody>
                            <?php foreach ($recentUsers as $user): ?>
                                <tr>
                                    <td><?= htmlspecialchars($user['name']) ?></td>
                                    <td class="text-secondary"><?= htmlspecialchars($user['email']) ?></td>
                                    <td class="text-end"><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <div class="col-lg-5">
            <section class="panel p-0 h-100" aria-labelledby="top-ch">
                <h2 class="section-title px-4 pt-4" id="top-ch">Desafios mais resolvidos</h2>
                <div class="table-wrap">
                    <table class="table">
                        <thead><tr><th scope="col">Desafio</th><th scope="col" class="text-end">Resoluções</th></tr></thead>
                        <tbody>
                            <?php foreach ($topChallenges as $challenge): ?>
                                <tr>
                                    <td><?= htmlspecialchars($challenge['title']) ?></td>
                                    <td class="text-end"><?= (int) $challenge['total'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
