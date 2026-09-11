<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<script>
document.body.classList.add('dashboard-page');
</script>

<div class="main-content">

<div class="container-fluid">

<h2 class="mb-4">

🛡️ Painel do Operador
<p class="text-secondary mb-4">

Bem-vindo ao CyberSec.
Continue sua jornada em cibersegurança.

</p>

</h2>

<div class="row">

<div class="col-md-4">

<div class="card stat-card shadow">

<div class="card-body">

<h6>XP Atual</h6>

<h2>
<?= $stats['xp'] ?>
</h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card stat-card shadow">

<div class="card-body">

<h6>Nível Atual</h6>

<h2>
<?= $stats['level'] ?>
</h2>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card stat-card shadow">

<div class="card-body">

<h6>Desafios Resolvidos</h6>

<h2>
<?= $stats['solved'] ?>
</h2>

</div>

</div>

</div>

</div>

<div class="card shadow mt-4">

<div class="card-header">

Atividades Recentes

</div>

<div class="card-body">

<?php if(empty($activities)): ?>

<p>
Nenhuma atividade encontrada.
</p>

<?php else: ?>

<ul class="list-group">

<?php foreach($activities as $activity): ?>

<li class="list-group-item">

<strong>

<?= htmlspecialchars(
    $activity['action']
) ?>

</strong>

<br>

<?= htmlspecialchars(
    $activity['description']
) ?>

<small
class="d-block text-muted">

<?= date(
    'd/m/Y H:i',
    strtotime(
        $activity['created_at']
    )
) ?>

</small>

</li>

<?php endforeach; ?>

</ul>

<?php endif; ?>

</div>

</div>

</div>

</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>