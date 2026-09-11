<div class="sidebar">

<a href="<?= BASE_URL ?>/dashboard">
Dashboard
</a>

<a href="<?= BASE_URL ?>/profile">
Perfil
</a>

<a href="<?= BASE_URL ?>/paths">
Trilhas
</a>

<a
href="<?= BASE_URL ?>/labs"
class="list-group-item list-group-item-action">
Laboratórios
</a>

<a href="<?= BASE_URL ?>/challenges">
Desafios
</a>

<a href="<?= BASE_URL ?>/ranking">
Ranking
</a>



<li>
    <a href="<?= BASE_URL ?>/certificate">
        Certificado
    </a>
</li>

<?php if(Auth::isAdmin()): ?>

<a href="<?= BASE_URL ?>/admin">
Administração
</a>

<?php endif; ?>

</div>