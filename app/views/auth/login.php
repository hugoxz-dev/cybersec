<?php $pageTitle = 'Entrar'; require_once __DIR__ . '/../layouts/header.php'; ?>

<main class="auth-shell">

    <section class="auth-hero">
        <a class="brand" href="<?= BASE_URL ?>/login">
            <span class="brand-mark" aria-hidden="true"></span>
            CYBERSEC
        </a>

        <h1 class="auth-word">CYBER<br>SEC</h1>

        <p class="lead-initial">Aprenda segurança ofensiva e defensiva na prática: trilhas guiadas, laboratórios com material real e desafios de captura de flag.</p>

        <ul class="auth-facts">
            <li><strong>Trilhas</strong>do básico ao avançado</li>
            <li><strong>Labs</strong>Web, Linux, Redes, OSINT</li>
            <li><strong>CTF</strong>flags valendo XP</li>
        </ul>
    </section>

    <section class="auth-card" aria-labelledby="login-title">
        <h2 id="login-title">Entrar</h2>
        <p class="auth-sub">Continue de onde parou.</p>

        <?php if (Session::has('error')): ?>
            <div class="alert alert-danger" role="alert"><?= htmlspecialchars((string) Session::get('error')) ?></div>
            <?php Session::remove('error'); ?>
        <?php endif; ?>

        <?php if (Session::has('success')): ?>
            <div class="alert alert-success" role="status"><?= htmlspecialchars((string) Session::get('success')) ?></div>
            <?php Session::remove('success'); ?>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/login" method="POST">
<?= Csrf::field() ?>
            <div class="field">
                <label for="email">E-mail</label>
                <input id="email" type="email" name="email" class="form-control" autocomplete="email" required autofocus>
            </div>

            <div class="field">
                <label for="password">Senha</label>
                <input id="password" type="password" name="password" class="form-control" autocomplete="current-password" required>
            </div>

            <button class="btn btn-glow btn-lg w-100 mt-2" type="submit">Entrar</button>
        </form>

        <p class="auth-switch">Ainda não tem conta? <a href="<?= BASE_URL ?>/register">Criar conta</a></p>
    </section>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
