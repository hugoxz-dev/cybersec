<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<div class="main-content">

<div class="container-fluid">

<h2 class="mb-4">
Meu Perfil
</h2>

<?php if(Session::has('success')): ?>

<div class="alert alert-success">
<?= Session::get('success'); ?>
</div>

<?php Session::remove('success'); ?>

<?php endif; ?>

<?php if(Session::has('error')): ?>

<div class="alert alert-danger">
<?= Session::get('error'); ?>
</div>

<?php Session::remove('error'); ?>

<?php endif; ?>

<div class="row">

<div class="col-lg-6">

<div class="card shadow">

<div class="card-header">
Dados do Perfil
</div>

<div class="card-body">

<form
method="POST"
action="<?= BASE_URL ?>/profile/update"
enctype="multipart/form-data">

<div class="text-center mb-3">

<?php if(!empty($user['photo'])): ?>

<img
src="<?= BASE_URL ?>/assets/uploads/profiles/<?= $user['photo'] ?>"
width="120"
height="120"
class="rounded-circle">

<?php else: ?>

<img
src="https://via.placeholder.com/120"
class="rounded-circle">

<?php endif; ?>

</div>

<div class="mb-3">

<label>Nome</label>

<input
type="text"
name="name"
value="<?= htmlspecialchars($user['name']) ?>"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
value="<?= htmlspecialchars($user['email']) ?>"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Foto</label>

<input
type="file"
name="photo"
class="form-control">

</div>

<button
class="btn btn-primary">

Salvar Alterações

</button>

</form>

</div>

</div>

</div>

<div class="col-lg-6">

<div class="card shadow">

<div class="card-header">
Alterar Senha
</div>

<div class="card-body">

<?php if(Session::has('success_password')): ?>

<div class="alert alert-success">
<?= Session::get('success_password'); ?>
</div>

<?php Session::remove('success_password'); ?>

<?php endif; ?>

<?php if(Session::has('error_password')): ?>

<div class="alert alert-danger">
<?= Session::get('error_password'); ?>
</div>

<?php Session::remove('error_password'); ?>

<?php endif; ?>

<form
method="POST"
action="<?= BASE_URL ?>/profile/password">

<div class="mb-3">

<label>Nova Senha</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Confirmar Senha</label>

<input
type="password"
name="confirm_password"
class="form-control"
required>

</div>

<button
class="btn btn-warning">

Alterar Senha

</button>

</form>

</div>

</div>

</div>

</div>

</div>

</div>

<div class="card shadow mt-4">

<div class="card-header">

Conquistas

</div>

<div class="card-body">

<?php if(empty($badges)): ?>

<p>
Nenhuma conquista obtida.
</p>

<?php else: ?>

<div class="row">

<?php foreach($badges as $badge): ?>

<div class="col-md-4 mb-3">

<div class="card">

<div class="card-body text-center">

<h1>

<?= $badge['icon'] ?>

</h1>

<h5>

<?= htmlspecialchars(
    $badge['name']
) ?>

</h5>

<p>

<?= htmlspecialchars(
    $badge['description']
) ?>

</p>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

<?php endif; ?>

</div>

</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>