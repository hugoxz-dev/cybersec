<?php
require_once __DIR__ . '/../../layouts/header.php';
require_once __DIR__ . '/../../layouts/navbar.php';
require_once __DIR__ . '/../../layouts/sidebar.php';
?>

<div class="main-content">

<h2 class="mb-4">

Editar Laboratório

</h2>

<form
method="POST"
action="<?= BASE_URL ?>/admin/labs/update">

<input
type="hidden"
name="id"
value="<?= $lab['id'] ?>">

<div class="mb-3">

<label>Título</label>

<input
type="text"
name="title"
class="form-control"
value="<?= htmlspecialchars($lab['title']) ?>"
required>

</div>

<div class="mb-3">

<label>Descrição</label>

<textarea
name="description"
class="form-control"
rows="3"
required><?= htmlspecialchars($lab['description']) ?></textarea>

</div>

<div class="mb-3">

<label>Categoria</label>

<input
type="text"
name="category"
class="form-control"
value="<?= htmlspecialchars($lab['category']) ?>"
required>

</div>

<div class="mb-3">

<label>Dificuldade</label>

<select
name="difficulty"
class="form-control">

<option
<?= $lab['difficulty'] === 'Iniciante' ? 'selected' : '' ?>>

Iniciante

</option>

<option
<?= $lab['difficulty'] === 'Intermediário' ? 'selected' : '' ?>>

Intermediário

</option>

<option
<?= $lab['difficulty'] === 'Avançado' ? 'selected' : '' ?>>

Avançado

</option>

</select>

</div>

<div class="mb-3">

<label>XP</label>

<input
type="number"
name="xp_reward"
class="form-control"
value="<?= $lab['xp_reward'] ?>">

</div>

<div class="mb-3">

<label>Material</label>

<textarea
name="material"
class="form-control"
rows="8"
required><?= htmlspecialchars($lab['material']) ?></textarea>

</div>

<div class="mb-3">

<label>Pergunta</label>

<textarea
name="question"
class="form-control"
rows="3"
required><?= htmlspecialchars($lab['question']) ?></textarea>

</div>

<div class="mb-3">

<label>Resposta</label>

<input
type="text"
name="answer"
class="form-control"
value="<?= htmlspecialchars($lab['answer']) ?>"
required>

</div>

<button
type="submit"
class="btn btn-warning">

Salvar Alterações

</button>

<a
href="<?= BASE_URL ?>/admin/labs"
class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

<?php
require_once __DIR__ . '/../../layouts/footer.php';
?>