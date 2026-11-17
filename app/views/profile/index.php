<?php
$pageTitle = 'Perfil';
require_once __DIR__ . '/../layouts/header.php';

$parts = preg_split('/\s+/', trim($user['name'] ?? ''));
$initials = mb_strtoupper(mb_substr($parts[0] ?? '', 0, 1) . mb_substr(count($parts) > 1 ? end($parts) : '', 0, 1));
?>

<main class="main-content">

    <header class="page-head">
        <div class="profile-id" style="margin: 0">
            <?php if (!empty($user['photo'])): ?>
                <img class="avatar" src="<?= BASE_URL ?>/assets/uploads/profiles/<?= htmlspecialchars($user['photo']) ?>" alt="Sua foto de perfil">
            <?php else: ?>
                <span class="avatar" aria-hidden="true"><?= htmlspecialchars($initials) ?></span>
            <?php endif; ?>
            <div>
                <h1 class="page-title" style="font-size: clamp(1.8rem, 4.6vw, 3.4rem)"><?= htmlspecialchars($user['name']) ?></h1>
                <p class="text-secondary m-0 mt-2"><?= htmlspecialchars($user['email']) ?></p>
            </div>
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

    <section aria-labelledby="badges-title" class="mb-5">
        <h2 class="section-title" id="badges-title">Conquistas</h2>
        <?php if (empty($badges)): ?>
            <div class="empty pt-0"><strong>Nenhuma conquista ainda</strong>Conquistas são liberadas ao concluir aulas, labs e desafios.</div>
        <?php else: ?>
            <div class="badge-grid">
                <?php foreach ($badges as $badge): ?>
                    <div class="medal">
                        <div class="medal-icon" aria-hidden="true"><?= htmlspecialchars($badge['icon'] ?? '') ?></div>
                        <h4><?= htmlspecialchars($badge['name']) ?></h4>
                        <p><?= htmlspecialchars($badge['description']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

    <div class="row g-4">

        <div class="col-lg-7">
            <section class="panel h-100" aria-labelledby="data-title">
                <h2 class="section-title" id="data-title">Dados do perfil</h2>
                <form method="POST" action="<?= BASE_URL ?>/profile/update" enctype="multipart/form-data">
<?= Csrf::field() ?>
                    <div class="row g-3">
                        <div class="col-md-6 field mb-0">
                            <label for="p-name">Nome</label>
                            <input id="p-name" type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" class="form-control" required>
                        </div>
                        <div class="col-md-6 field mb-0">
                            <label for="p-email">E-mail</label>
                            <input id="p-email" type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="form-control" required>
                        </div>
                        <div class="col-12 field">
                            <label for="p-photo">Foto de perfil</label>
                            <input id="p-photo" type="file" name="photo" accept="image/*" class="form-control">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Salvar alterações</button>
                </form>
            </section>
        </div>

        <div class="col-lg-5">
            <section class="panel h-100" aria-labelledby="pass-title">
                <h2 class="section-title" id="pass-title">Alterar senha</h2>

                <?php if (Session::has('success_password')): ?>
                    <div class="alert alert-success mb-3" role="status"><?= htmlspecialchars((string) Session::get('success_password')) ?></div>
                    <?php Session::remove('success_password'); ?>
                <?php endif; ?>

                <?php if (Session::has('error_password')): ?>
                    <div class="alert alert-danger mb-3" role="alert"><?= htmlspecialchars((string) Session::get('error_password')) ?></div>
                    <?php Session::remove('error_password'); ?>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>/profile/password">
<?= Csrf::field() ?>
                    <div class="field">
                        <label for="p-pass">Nova senha</label>
                        <input id="p-pass" type="password" name="password" class="form-control" autocomplete="new-password" required>
                    </div>
                    <div class="field">
                        <label for="p-pass2">Confirmar nova senha</label>
                        <input id="p-pass2" type="password" name="confirm_password" class="form-control" autocomplete="new-password" required>
                    </div>
                    <button class="btn btn-ghost" type="submit">Alterar senha</button>
                </form>
            </section>
        </div>

    </div>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
