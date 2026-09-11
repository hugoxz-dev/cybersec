<?php
require_once __DIR__ . '/../../layouts/header.php';
require_once __DIR__ . '/../../layouts/navbar.php';
require_once __DIR__ . '/../../layouts/sidebar.php';
?>

<div class="main-content">

<a
href="javascript:history.back()"
class="btn btn-outline-light mb-3">

← Voltar

</a>

<div class="d-flex justify-content-between mb-4">

<h2>
Perguntas da Aula
</h2>

<a
href="<?= BASE_URL ?>/admin/questions/create?lesson_id=<?= $lessonId ?>"
class="btn btn-success">

Nova Pergunta

</a>

</div>

<div class="card">

<div class="card-body">

<table class="table">

<thead>

<tr>
<th>ID</th>
<th>Pergunta</th>
<th>Resposta Correta</th>
<th>Ações</th>
</tr>

</thead>

<tbody>

<?php foreach($questions as $question): ?>

<tr>

<td>
<?= $question['id'] ?>
</td>

<td>
<?= htmlspecialchars(
    $question['question']
) ?>
</td>

<td>

<a
href="<?= BASE_URL ?>/admin/questions/edit?id=<?= $question['id'] ?>"
class="btn btn-warning btn-sm">

Editar

</a>

</td>

<td>
<?= $question['correct_option'] ?>
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