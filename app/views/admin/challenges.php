<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php require_once __DIR__ . '/../layouts/back_button.php'; ?>

<div class="container mt-4">

<h2>Desafios</h2>

<table class="table">

<tr>
<th>ID</th>
<th>Título</th>
<th>Dificuldade</th>
<th>XP</th>
</tr>

<?php foreach ($challenges as $challenge): ?>

<tr>

<td><?= $challenge['id'] ?></td>
<td><?= $challenge['title'] ?></td>
<td><?= $challenge['difficulty'] ?></td>
<td><?= $challenge['xp_reward'] ?></td>

</tr>

<?php endforeach; ?>

</table>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>