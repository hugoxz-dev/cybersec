<?php
require_once __DIR__ . '/../../layouts/header.php';
require_once __DIR__ . '/../../layouts/navbar.php';
require_once __DIR__ . '/../../layouts/sidebar.php';
?>

<div class="main-content">

<div class="d-flex justify-content-between mb-4">

<h2>

🧪 Gerenciar Laboratórios

</h2>

<a
href="<?= BASE_URL ?>/admin/labs/create"
class="btn btn-success">

Novo Laboratório

</a>

</div>

<div class="mb-4">

<a
href="<?= BASE_URL ?>/labs"
class="btn btn-outline-light btn-sm">

Todos

</a>

<a
href="<?= BASE_URL ?>/labs?category=Web Security"
class="btn btn-outline-info btn-sm">

🌐 Web

</a>

<a
href="<?= BASE_URL ?>/labs?category=Linux"
class="btn btn-outline-success btn-sm">

🐧 Linux

</a>

<a
href="<?= BASE_URL ?>/labs?category=Redes"
class="btn btn-outline-primary btn-sm">

🌍 Redes

</a>

<a
href="<?= BASE_URL ?>/labs?category=OSINT"
class="btn btn-outline-warning btn-sm">

📦 OSINT

</a>

<a
href="<?= BASE_URL ?>/labs?category=Forense"
class="btn btn-outline-danger btn-sm">

🔍 Forense

</a>

</div>

<div class="card">

<div class="card-body">

<table class="table">

<thead>

<tr>

<th>ID</th>
<th>Título</th>
<th>Categoria</th>
<th>XP</th>
<th>Ações</th>

</tr>

</thead>

<tbody>

<?php foreach($labs as $lab): ?>

<tr>

<td><?= $lab['id'] ?></td>

<td>
<?= htmlspecialchars(
    $lab['title']
) ?>
</td>

<td>

<?= $lab['xp_reward'] ?>

</td>

<td>

<a
href="<?= BASE_URL ?>/admin/labs/edit?id=<?= $lab['id'] ?>"
class="btn btn-warning btn-sm">

Editar

</a>

<form
method="POST"
action="<?= BASE_URL ?>/admin/labs/delete"
style="display:inline;">

<input
type="hidden"
name="id"
value="<?= $lab['id'] ?>">

<button
type="submit"
class="btn btn-danger btn-sm"
onclick="return confirm('Excluir laboratório?')">

Excluir

</button>

</form>

</td>

<td>
<?= $lab['xp_reward'] ?>
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