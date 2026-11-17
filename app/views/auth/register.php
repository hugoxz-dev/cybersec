<?php $pageTitle = 'Criar conta'; require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="auth-shell">

    <section class="auth-hero">
        <a class="brand" href="<?= BASE_URL ?>/login">
            <span class="brand-mark" aria-hidden="true"></span>
            CYBERSEC
        </a>

        <h1 class="auth-word">COMECE<br>AQUI</h1>

        <p class="lead-initial">Você começa como Iniciante. Cada aula, laboratório e flag resolvida rende XP e libera o próximo nível, até a Elite.</p>

        <ul class="auth-facts">
            <li><strong>5 níveis</strong>de Iniciante a Elite</li>
            <li><strong>Ranking</strong>global por XP</li>
            <li><strong>Certificado</strong>com código próprio</li>
        </ul>
    </section>

    <section class="auth-card" aria-labelledby="register-title">
        <h2 id="register-title">Criar conta</h2>
        <p class="auth-sub">Leva menos de um minuto.</p>

        <?php if (Session::has('error')): ?>
            <div class="alert alert-danger" role="alert"><?= htmlspecialchars((string) Session::get('error')) ?></div>
            <?php Session::remove('error'); ?>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/register" method="POST">
<?= Csrf::field() ?>
            <div class="field">
                <label for="name">Nome</label>
                <input id="name" type="text" name="name" class="form-control" autocomplete="name" required autofocus>
            </div>

            <div class="field">
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" class="form-control" autocomplete="email" required>
            </div>

            <div class="field">
                <label for="password">Senha</label>
                <input id="password" type="password" name="password" class="form-control" autocomplete="new-password" minlength="6" required>
                <small class="text-secondary d-block mt-2">Mínimo de 6 caracteres.</small>
            </div>

            <button class="btn btn-glow btn-lg w-100 mt-2" type="submit">Criar conta</button>
        </form>

        <p class="auth-switch">Já tem conta? <a href="<?= BASE_URL ?>/login">Entrar</a></p>
    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
