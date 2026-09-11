<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php require_once __DIR__ . '/../layouts/back_button.php'; ?>

<div class="container mt-4">

<h2 class="mb-4">
🏆 Ranking Global
</h2>

<div class="card shadow">

<div class="card-body">

<table class="table">

<thead>

<tr>
<th>#</th>
<th>Usuário</th>
<th>Nível</th>
<th>XP</th>
<th>Resolvidos</th>
</tr>

</thead>

<tbody>

<?php $posicao = 1; ?>

<?php foreach($ranking as $user): ?>

<tr>

<td>
<?= $posicao++ ?>
</td>

<td>
<?= htmlspecialchars(
    $user['name']
) ?>
</td>

<td>
<?= htmlspecialchars(
    $user['level_name']
)
?>
</td>

<td>
<?= $user['xp'] ?>
</td>

<td>
<?= $user['solved'] ?>
</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>