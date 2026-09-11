<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php require_once __DIR__ . '/../layouts/back_button.php'; ?>

<div class="container mt-4">

<h2 class="mb-4">

⚙️ Central Administrativa

</h2>

<div class="row">

<div class="col-md-3">

<div class="card shadow">

<div class="card-body text-center">

<h6>Usuários</h6>

<h2>
<?= $stats['users'] ?>
</h2>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow">

<div class="card-body text-center">

<h6>Desafios</h6>

<h2>
<?= $stats['challenges'] ?>
</h2>

</div>

</div>

</div>

<div class="col-md-3">

    <a
    href="<?= BASE_URL ?>/admin/paths"
    class="btn btn-primary w-100">

        Trilhas

    </a>

</div>

<div class="col-md-3">

<div class="card shadow">

<div class="card-body text-center">

<h6>Submissões</h6>

<h2>
<?= $stats['submissions'] ?>
</h2>

</div>

</div>

</div>

<div class="col-md-3">

<div class="card shadow">

<div class="card-body text-center">

<h6>Acertos</h6>

<h2>
<?= $stats['correct'] ?>
</h2>

</div>

</div>

</div>

</div>

 <div class="card shadow mt-4">

<div class="card-header">

Últimos Usuários Cadastrados

</div>

<div class="card-body">

<table class="table">

<thead>

<tr>
<th>Nome</th>
<th>Email</th>
<th>Cadastro</th>
</tr>

</thead>

<tbody>

<?php foreach($recentUsers as $user): ?>

<tr>

<td>
<?= htmlspecialchars($user['name']) ?>
</td>

<td>
<?= htmlspecialchars($user['email']) ?>
</td>

<td>
<?= date(
    'd/m/Y',
    strtotime($user['created_at'])
) ?>
</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

 <div class="card shadow mt-4">

<div class="card-header">

Desafios Mais Resolvidos

</div>

<div class="card-body">

<table class="table">

<thead>

<tr>
<th>Desafio</th>
<th>Resoluções</th>
</tr>

</thead>

<tbody>

<?php foreach($topChallenges as $challenge): ?>

<tr>

<td>
<?= htmlspecialchars(
    $challenge['title']
) ?>
</td>

<td>
<?= $challenge['total'] ?>
</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

<div class="mt-4">

<a
href="<?= BASE_URL ?>/admin/users"
class="btn btn-primary">

Gerenciar Usuários

</a>

<a
href="<?= BASE_URL ?>/admin/challenges"
class="btn btn-success">

Gerenciar Desafios

</a>

<a
href="<?= BASE_URL ?>/admin/labs"
class="btn btn-info">

Gerenciar Laboratórios

</a>

</div>

</div>

<div class="col-md-3">

<div class="card shadow">

<div class="card-body text-center">

<h6>Taxa de Acerto</h6>

<h2>

<?= $stats['accuracy'] ?>%

</h2>

</div>

</div>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>