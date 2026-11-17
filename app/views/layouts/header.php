<?php
$__path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$__base = rtrim(parse_url(BASE_URL, PHP_URL_PATH) ?: '', '/');
if ($__base !== '' && str_starts_with($__path, $__base)) {
    $__path = substr($__path, strlen($__base));
}
$__path = '/' . trim($__path, '/');

$__navItems = [
    ['/dashboard',   'Início',        ['/dashboard']],
    ['/paths',       'Trilhas',       ['/paths', '/path', '/lesson']],
    ['/labs',        'Laboratórios',  ['/labs', '/lab']],
    ['/challenges',  'Desafios',      ['/challenges', '/challenge']],
    ['/ranking',     'Ranking',       ['/ranking']],
    ['/certificate', 'Certificado',   ['/certificate']],
];

if (Auth::check() && Auth::isAdmin()) {
    $__navItems[] = ['/admin', 'Admin', ['/admin']];
}

$__isActive = function (array $prefixes) use ($__path): bool {
    foreach ($prefixes as $p) {
        if ($__path === $p || str_starts_with($__path, $p . '/')) {
            return true;
        }
    }
    return false;
};

$__user = Auth::user();
$__showNav = Auth::check() && empty($hideNav);
$__initials = '';
if ($__user) {
    $parts = preg_split('/\s+/', trim($__user['name'] ?? ''));
    $__initials = mb_strtoupper(mb_substr($parts[0] ?? '', 0, 1) . mb_substr(count($parts) > 1 ? end($parts) : '', 0, 1));
}
?>
<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' · ' : '' ?>CyberSec</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,300..700&family=Geist+Mono:wght@400;500&family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css?v=<?= @filemtime(__DIR__ . '/../../../public/assets/css/style.css') ?: time() ?>">
</head>
<body class="<?= htmlspecialchars($bodyClass ?? '') ?>">

<div class="atmosphere" aria-hidden="true">
    <div class="stars"></div>
    <div class="guides"><span></span><span></span><span></span></div>
</div>

<?php if ($__showNav): ?>
<header class="topbar" id="topbar">

    <a class="brand" href="<?= BASE_URL ?>/dashboard" aria-label="CyberSec, ir para o início">
        <span class="brand-mark" aria-hidden="true"></span>
        CYBERSEC
    </a>

    <nav class="pill-nav" id="mainNav" aria-label="Principal">
        <?php foreach ($__navItems as [$href, $label, $prefixes]): ?>
            <a href="<?= BASE_URL . $href ?>"
               class="<?= $__isActive($prefixes) ? 'active' : '' ?>"
               <?= $__isActive($prefixes) ? 'aria-current="page"' : '' ?>>
                <?= $label ?>
            </a>
        <?php endforeach; ?>
    </nav>

    <div class="user-pill">
        <span class="user-name"><?= htmlspecialchars($__user['name'] ?? '') ?></span>
        <form method="POST" action="<?= BASE_URL ?>/logout" class="logout-form">
            <?= Csrf::field() ?>
            <button class="logout" type="submit">Sair</button>
        </form>
        <a href="<?= BASE_URL ?>/profile" aria-label="Meu perfil">
            <?php if (!empty($__user['photo'])): ?>
                <img class="avatar" src="<?= BASE_URL ?>/assets/uploads/profiles/<?= htmlspecialchars($__user['photo']) ?>" alt="">
            <?php else: ?>
                <span class="avatar"><?= htmlspecialchars($__initials) ?></span>
            <?php endif; ?>
        </a>
    </div>

    <button class="nav-toggle" id="navToggle" type="button" aria-controls="mainNav" aria-expanded="false" aria-label="Abrir menu">
        <span></span>
    </button>

</header>
<?php endif; ?>
