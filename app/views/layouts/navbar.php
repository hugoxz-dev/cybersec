<nav class="navbar navbar-expand-lg navbar-dark fixed-top">

<div class="container-fluid">

<button
id="sidebarToggle"
class="btn btn-outline-light me-3">

☰

</button>

<a
class="navbar-brand fw-bold"
href="<?= BASE_URL ?>/dashboard">

🛡️ CyberSec

</a>

<div class="d-flex align-items-center">

<span class="text-white me-3">

<?= htmlspecialchars(
    Auth::user()['name']
); ?>

</span>

<a
href="<?= BASE_URL ?>/logout"
class="btn btn-danger btn-sm">

Sair

</a>

</div>

</div>

</nav>