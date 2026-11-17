<?php
$backHref  = $backHref  ?? BASE_URL . '/dashboard';
$backLabel = $backLabel ?? 'Voltar ao início';
?>
<a class="back-link" href="<?= htmlspecialchars($backHref) ?>"><?= htmlspecialchars($backLabel) ?></a>
