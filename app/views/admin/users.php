<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php require_once __DIR__ . '/../layouts/back_button.php'; ?>

<div class="container mt-4">

<h2>Usuários</h2>

<table class="table">

<tr>
<th>ID</th>
<th>Nome</th>
<th>Email</th>
<th>XP</th>
</tr>

<?php foreach ($users as $user): ?>

<tr>

<td><?= $user['id'] ?></td>
<td><?= $user['name'] ?></td>
<td><?= $user['email'] ?></td>
<td><?= $user['xp'] ?></td>

</tr>

<?php endforeach; ?>

</table>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>