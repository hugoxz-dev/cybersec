<?php
require_once __DIR__ . '/../../layouts/header.php';
require_once __DIR__ . '/../../layouts/navbar.php';
require_once __DIR__ . '/../../layouts/sidebar.php';
?>

<div class="main-content">

<div class="d-flex justify-content-between mb-4">

<h2>
Trilhas de Aprendizagem
</h2>

<a
href="<?= BASE_URL ?>/admin/paths/create"
class="btn btn-success">

Nova Trilha

</a>

</div>

<div class="card">

<div class="card-body">

<table class="table">

<thead>

<tr>
<th>ID</th>
<th>Título</th>
<th>Ações</th>
</tr>

</thead>

<tbody>

<?php foreach($paths as $path): ?>

<tr>

<td>
<?= $path['id'] ?>
</td>

<td>
<?= htmlspecialchars($path['title']) ?>
</td>

<td>

<a
href="<?= BASE_URL ?>/path?id=<?= $path['id'] ?>"
class="btn btn-primary btn-sm">

Ver

</a>

<a
href="<?= BASE_URL ?>/admin/lessons?path_id=<?= $path['id'] ?>"
class="btn btn-success btn-sm">

Aulas

</a>

<form
method="POST"
action="<?= BASE_URL ?>/admin/paths/delete"
style="display:inline;">

<input
type="hidden"
name="id"
value="<?= $path['id'] ?>">

<button
type="submit"
class="btn btn-danger btn-sm"
onclick="return confirm('Excluir trilha?')">

Excluir

</button>

</form>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

<?php
require_once __DIR__ . '/../../layouts/footer.php';
?>