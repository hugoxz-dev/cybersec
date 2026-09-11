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

<div class="card">

<div class="card-body">

<h2 class="mb-4">

Nova Pergunta

</h2>

<form
method="POST"
action="<?= BASE_URL ?>/admin/questions/store">

<input
type="hidden"
name="lesson_id"
value="<?= $lessonId ?>">

<div class="mb-3">

<label class="form-label">

Pergunta

</label>

<textarea
name="question"
class="form-control"
rows="4"
required></textarea>

</div>

<div class="mb-3">

<label>Alternativa A</label>

<input
type="text"
name="option_a"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Alternativa B</label>

<input
type="text"
name="option_b"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Alternativa C</label>

<input
type="text"
name="option_c"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Alternativa D</label>

<input
type="text"
name="option_d"
class="form-control"
required>

</div>

<div class="mb-3">

<label>

Resposta Correta

</label>

<select
name="correct_option"
class="form-select"
required>

<option value="A">A</option>
<option value="B">B</option>
<option value="C">C</option>
<option value="D">D</option>

</select>

</div>

<button
type="submit"
class="btn btn-success">

Salvar Pergunta

</button>

</form>

</div>

</div>

</div>

<?php
require_once __DIR__ . '/../../layouts/footer.php';
?>