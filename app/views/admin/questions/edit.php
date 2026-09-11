<?php
require_once __DIR__ . '/../../layouts/header.php';
require_once __DIR__ . '/../../layouts/navbar.php';
require_once __DIR__ . '/../../layouts/sidebar.php';
?>

<div class="main-content">

<div class="card">

<div class="card-body">

<h2 class="mb-4">

Editar Pergunta

</h2>

<form
method="POST"
action="<?= BASE_URL ?>/admin/questions/update">

<input
type="hidden"
name="id"
value="<?= $question['id'] ?>">

<div class="mb-3">

<label>Pergunta</label>

<textarea
name="question"
class="form-control"
rows="4"
required><?= htmlspecialchars($question['question']) ?></textarea>

</div>

<div class="mb-3">

<label>Alternativa A</label>

<input
type="text"
name="option_a"
value="<?= htmlspecialchars($question['option_a']) ?>"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Alternativa B</label>

<input
type="text"
name="option_b"
value="<?= htmlspecialchars($question['option_b']) ?>"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Alternativa C</label>

<input
type="text"
name="option_c"
value="<?= htmlspecialchars($question['option_c']) ?>"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Alternativa D</label>

<input
type="text"
name="option_d"
value="<?= htmlspecialchars($question['option_d']) ?>"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Resposta Correta</label>

<select
name="correct_option"
class="form-select">

<option value="A" <?= $question['correct_option']=='A' ? 'selected' : '' ?>>A</option>
<option value="B" <?= $question['correct_option']=='B' ? 'selected' : '' ?>>B</option>
<option value="C" <?= $question['correct_option']=='C' ? 'selected' : '' ?>>C</option>
<option value="D" <?= $question['correct_option']=='D' ? 'selected' : '' ?>>D</option>

</select>

</div>

<button
type="submit"
class="btn btn-success">

Salvar Alterações

</button>

</form>

</div>

</div>

</div>

<?php
require_once __DIR__ . '/../../layouts/footer.php';
?>