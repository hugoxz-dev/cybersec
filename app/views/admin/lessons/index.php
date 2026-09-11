<?php
require_once __DIR__ . '/../../layouts/header.php';
require_once __DIR__ . '/../../layouts/navbar.php';
require_once __DIR__ . '/../../layouts/sidebar.php';
?>

<div class="main-content">

<a
href="<?= BASE_URL ?>/admin/paths"
class="btn btn-outline-light mb-3">

← Voltar para Trilhas

</a>

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>

Aulas da Trilha:
<?= htmlspecialchars($path['title']) ?>

</h2>

<a
href="<?= BASE_URL ?>/admin/lessons/create?path_id=<?= $path['id'] ?>"
class="btn btn-success">

Nova Aula

</a>

</div>

<div class="card">

<div class="card-body">

<?php if(empty($lessons)): ?>

<div class="alert alert-info">

Nenhuma aula cadastrada.

</div>

<?php else: ?>

<table class="table">

<thead>

<tr>
<th>Ordem</th>
<th>Título</th>
<th>Ações</th>
</tr>

</thead>

<tbody>

<?php foreach($lessons as $lesson): ?>

<tr>

<td>

<?= $lesson['lesson_order'] ?>

</td>

<td>

<?= htmlspecialchars(
    $lesson['title']
) ?>

</td>

<td>

<a
href="<?= BASE_URL ?>/lesson?id=<?= $lesson['id'] ?>"
class="btn btn-primary btn-sm">

Visualizar

</a>

<a
href="<?= BASE_URL ?>/admin/questions?lesson_id=<?= $lesson['id'] ?>"
class="btn btn-info btn-sm">

Quiz

</a>

<form
method="POST"
action="<?= BASE_URL ?>/admin/lessons/delete"
style="display:inline;">

<input
type="hidden"
name="id"
value="<?= $lesson['id'] ?>">

<button
type="submit"
class="btn btn-danger btn-sm">

Excluir

</button>

</form>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<?php endif; ?>

</div>

</div>

</div>

<?php
require_once __DIR__ . '/../../layouts/footer.php';
?>