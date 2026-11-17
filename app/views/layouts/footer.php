<?php if (Auth::check() && empty($hideNav)): ?>
<footer class="site-foot">
    <span>CyberSec — plataforma de estudos em cibersegurança</span>
    <span>Pratique apenas em ambientes autorizados.</span>
</footer>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>/assets/js/app.js?v=<?= @filemtime(__DIR__ . '/../../../public/assets/js/app.js') ?: time() ?>"></script>
</body>
</html>
