<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<style>
.path-card {
    background: #1e293b;
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 14px;
    transition: 0.2s ease;
    overflow: hidden;
}

.path-card:hover {
    transform: translateY(-4px);
    border-color: rgba(59,130,246,0.4);
}

.path-header {
    padding: 18px;
    border-bottom: 1px solid rgba(255,255,255,0.05);
}

.path-body {
    padding: 18px;
}

.badge-difficulty {
    font-size: 12px;
    padding: 4px 10px;
    border-radius: 20px;
    display: inline-block;
}

.diff-iniciante { background: #14532d; color: #4ade80; }
.diff-intermediario { background: #1e3a8a; color: #60a5fa; }
.diff-avancado { background: #7f1d1d; color: #f87171; }

.progress {
    height: 8px;
    border-radius: 10px;
    background: rgba(255,255,255,0.08);
}

.progress-bar {
    border-radius: 10px;
}

.path-btn {
    background: #2563eb;
    border: none;
    padding: 10px;
    border-radius: 10px;
    width: 100%;
    color: white;
    font-weight: 500;
    transition: 0.2s;
}

.path-btn:hover {
    background: #1d4ed8;
}
</style>

<div class="main-content">

<h2 class="mb-4">🎓 Trilhas de Aprendizagem</h2>

<div class="row">

<?php foreach($paths as $path): ?>

<?php
$learningPath = new LearningPath();

$progress = $learningPath->getProgress(
    $path['id'],
    Auth::id()
);

$lessonCount = count(
    $learningPath->getLessons($path['id'])
);

$difficulty = strtolower($path['difficulty'] ?? 'iniciante');
?>

<div class="col-md-4 mb-4">

<div class="path-card">

<div class="path-header">

<h5 class="mb-2 text-white">
<?= htmlspecialchars($path['title']) ?>
</h5>

<span class="badge-difficulty diff-<?= $difficulty ?>">
<?= ucfirst($difficulty) ?>
</span>

</div>

<div class="path-body">

<p class="text-secondary small mb-2">
<?= htmlspecialchars($path['description']) ?>
</p>

<p class="mb-2 text-light">
📚 <?= $lessonCount ?> aulas
</p>

<p class="mb-3 text-light">
⭐ <?= $path['xp_reward'] ?> XP total
</p>

<div class="progress mb-3">
<div class="progress-bar bg-success"
style="width: <?= $progress ?>%"></div>
</div>

<div class="d-flex justify-content-between mb-3">
<small class="text-secondary">
<?= $progress ?>% concluído
</small>

<small class="text-secondary">
🎯 Progresso
</small>
</div>

<a href="<?= BASE_URL ?>/path?id=<?= $path['id'] ?>"
class="path-btn">

<?= $progress > 0 ? 'Continuar trilha' : 'Iniciar trilha' ?>

</a>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>