<?php require_once __DIR__ . '/../layouts/header.php'; ?>

<?php require_once __DIR__ . '/../layouts/back_button.php'; ?>

<div class="container mt-4">

<h2>

Certificado

</h2>

<?php if(!$certificate): ?>

<div class="alert alert-info">

Você pode gerar um certificado
após resolver 5 desafios.

</div>

<form
method="POST"
action="<?= BASE_URL ?>/certificate/generate">

<button
class="btn btn-success">

Gerar Certificado

</button>

</form>

<?php else: ?>

<div class="card shadow">

<div class="card-body">

<h3>

CERTIFICADO DE CONCLUSÃO

</h3>

<hr>

<p>

Certificamos que o usuário

<strong>

<?= htmlspecialchars(
    Auth::user()['name']
) ?>

</strong>

concluiu os requisitos
da plataforma CyberSec.

</p>

<p>

Código:

<strong>

<?= $certificate['certificate_code'] ?>

</strong>

</p>

<p>

Emitido em:

<?= date(
    'd/m/Y',
    strtotime(
        $certificate['issued_at']
    )
) ?>

</p>

</div>

</div>

<?php endif; ?>

</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>