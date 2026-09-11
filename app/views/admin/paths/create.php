<?php
require_once __DIR__ . '/../../layouts/header.php';
require_once __DIR__ . '/../../layouts/navbar.php';
require_once __DIR__ . '/../../layouts/sidebar.php';
?>

<div class="main-content">

<div class="card">

<div class="card-header">

Nova Trilha

</div>

<div class="card-body">

<form
method="POST"
action="<?= BASE_URL ?>/admin/paths/store">

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

Descrição

</label>

<textarea
name="description"
class="form-control"
rows="5"
required></textarea>

</div>

<button
type="submit"
class="btn btn-success">

Salvar Trilha

</button>

</form>

</div>

</div>

</div>

<?php
require_once __DIR__ . '/../../layouts/footer.php';
?>