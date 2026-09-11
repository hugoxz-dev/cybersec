<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<?php require_once __DIR__ . '/../layouts/back_button.php'; ?>

<div class="main-content">

<div class="container-fluid">

<h2 class="mb-3">
<?= htmlspecialchars($challenge['title']) ?>
</h2>

<div class="card shadow">

<div class="card-body">

<p>
<strong>Dificuldade:</strong>
<?= htmlspecialchars($challenge['difficulty']) ?>
</p>

<p>
<strong>XP:</strong>
<?= (int)$challenge['xp_reward'] ?>
</p>

<hr>

<p>
<?= nl2br(
    htmlspecialchars(
        $challenge['description']
    )
) ?>
</p>

</div>

</div>

<?php if(Session::get('error')): ?>

<div class="alert alert-danger mt-3">

<?= Session::get('error') ?>

</div>

<?php endif; ?>

<?php if(Session::get('success')): ?>

<div class="alert alert-success mt-3">

<?= Session::get('success') ?>

</div>

<?php endif; ?>

<div class="card shadow mt-4">

<div class="card-header">

Enviar Flag

</div>

<div class="card-body">

<form
method="POST"
action="<?= BASE_URL ?>/challenge/submit">

<input
type="hidden"
name="challenge_id"
value="<?= $challenge['id'] ?>">

<div class="mb-3">

<label class="form-label">

Flag

</label>

<input
type="text"
name="flag"
class="form-control"
required>

</div>

<button
type="submit"
class="btn btn-success">

Enviar Flag

</button>

</form>

</div>

</div>

</div>

</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>