<?php
require_once __DIR__ . '/../../layouts/header.php';
require_once __DIR__ . '/../../layouts/navbar.php';
require_once __DIR__ . '/../../layouts/sidebar.php';
?>

<div class="main-content">

<h2 class="mb-4">

Novo Laboratório

</h2>

<form
method="POST"
action="<?= BASE_URL ?>/admin/labs/store">

<div class="mb-3">

<label>Título</label>

<input
type="text"
name="title"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Descrição</label>

<textarea
name="description"
class="form-control"
rows="3"
required></textarea>

</div>

<div class="mb-3">

<label>Categoria</label>

<input
type="text"
name="category"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Dificuldade</label>

<select
name="difficulty"
class="form-control">

<option>Iniciante</option>
<option>Intermediário</option>
<option>Avançado</option>

</select>

</div>

<div class="mb-3">

<label>XP</label>

<input
type="number"
name="xp_reward"
class="form-control"
value="50">

</div>

<div class="mb-3">

<label>Material</label>

<textarea
name="material"
class="form-control"
rows="8"
required></textarea>

</div>

<div class="mb-3">

<label>Pergunta</label>

<textarea
name="question"
class="form-control"
rows="3"
required></textarea>

</div>

<div class="mb-3">

<label>Resposta</label>

<input
type="text"
name="answer"
class="form-control"
required>

</div>

<button
type="submit"
class="btn btn-success">

Criar Laboratório

</button>

</form>

</div>

<?php
require_once __DIR__ . '/../../layouts/footer.php';
?>