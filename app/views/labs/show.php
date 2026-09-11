<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<div class="main-content">

<a
href="<?= BASE_URL ?>/labs"
class="btn btn-outline-light mb-3">

← Voltar

</a>

<?php if(Session::has('success')): ?>

<div class="alert alert-success">

    <?= Session::get('success') ?>

</div>

<?php Session::remove('success'); ?>

<?php endif; ?>

<?php if(Session::has('error')): ?>

<div class="alert alert-danger">

    <?= Session::get('error') ?>

</div>

<?php Session::remove('error'); ?>

<?php endif; ?>

<div class="card">

<div class="card-body">

<h2>

<?= htmlspecialchars(
    $lab['title']
) ?>

</h2>

<hr>

<p>

<?= htmlspecialchars(
    $lab['description']
) ?>

</p>

<div class="mt-4">

<h4>

📂 Material de Análise

</h4>

<pre
class="p-3 rounded mt-3"
style="
background: rgba(0,0,0,.4);
color: #fff;
white-space: pre-wrap;
">

<?= htmlspecialchars(
    $lab['material']
) ?>

</pre>

</div>

<div class="mt-4">

<h4>

❓ Pergunta

</h4>

<p>

<?= htmlspecialchars(
    $lab['question']
) ?>

</p>

</div>

<form
method="POST"
action="<?= BASE_URL ?>/lab/submit">

<input
type="hidden"
name="lab_id"
value="<?= $lab['id'] ?>">

<div class="mb-3">

<input
type="text"
name="answer"
class="form-control"
placeholder="Digite sua resposta"
required>

</div>

<button
type="submit"
class="btn btn-success">

Enviar Resposta

</button>

</form>

</div>

</div>

</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>