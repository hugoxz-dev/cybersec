
<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header">

<h3>Cadastro</h3>

</div>

<div class="card-body">

<?php if(Session::has('error')): ?>

<div class="alert alert-danger">

<?= Session::get('error'); ?>

</div>

<?php Session::remove('error'); ?>

<?php endif; ?>

<form
action="<?= BASE_URL ?>/register"
method="POST">

<div class="mb-3">

<label>Nome</label>

<input
type="text"
name="name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Senha</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
class="btn btn-success w-100">

Cadastrar

</button>

</form>

<hr>

<a
href="<?= BASE_URL ?>/login"
class="btn btn-outline-primary w-100">

Voltar para Login

</a>

</div>

</div>

</div>

</div>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>