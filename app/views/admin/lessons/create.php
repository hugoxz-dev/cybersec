<?php
require_once __DIR__ . '/../../layouts/header.php';
require_once __DIR__ . '/../../layouts/navbar.php';
require_once __DIR__ . '/../../layouts/sidebar.php';
?>

<div class="main-content">

<a
href="<?= BASE_URL ?>/admin/lessons?path_id=<?= $pathId ?>"
class="btn btn-outline-light mb-3">

← Voltar

</a>

<div class="card">

<div class="card-header">

Nova Aula

</div>

<div class="card-body">

<form
method="POST"
action="<?= BASE_URL ?>/admin/lessons/store">

<input
type="hidden"
name="path_id"
value="<?= $pathId ?>">

<div class="mb-3">

<label class="form-label">

Ordem da Aula

</label>

<input
type="number"
name="lesson_order"
class="form-control"
value="1"
required>

</div>

<div class="mb-3">

<label class="form-label">

Título

</label>

<input
type="text"
name="title"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Conteúdo

</label>

<textarea
name="content"
class="form-control"
rows="18"
required></textarea>

<small class="text-secondary">

Aqui você pode escrever toda a explicação teórica da aula.

</small>

</div>

<button
type="submit"
class="btn btn-success">

Salvar Aula

</button>

</form>

</div>

</div>

</div>

<?php
require_once __DIR__ . '/../../layouts/footer.php';
?>