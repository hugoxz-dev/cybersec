<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<script>
window.onload = function()
{
    document.body.classList.add('login-page');
};
</script>

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-5">

<div class="card shadow">

<div class="card-header">

<h3>Login</h3>

</div>

<div class="card-body">

<?php if(Session::has('error')): ?>

<div class="alert alert-danger">

<?= Session::get('error'); ?>

</div>

<?php Session::remove('error'); ?>

<?php endif; ?>

<form
action="<?= BASE_URL ?>/login"
method="POST">

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
class="btn btn-primary w-100">

Entrar

</button>

</form>

<hr>

<a
href="<?= BASE_URL ?>/register"
class="btn btn-outline-secondary w-100">

Criar Conta

</a>

</div>

</div>

</div>

</div>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>