<?php
$pageTitle = 'Ranking';
require_once __DIR__ . '/../layouts/header.php';

$ranking = array_values($ranking);
$top = array_slice($ranking, 0, 3);
$me = Auth::id();
// Ordem visual do pódio: 2º, 1º, 3º
$podiumOrder = array_filter([1 => $top[1] ?? null, 0 => $top[0] ?? null, 2 => $top[2] ?? null]);
?>

<main class="main-content">

    <header class="page-head">
        <div>
            <h1 class="page-title">Ranking</h1>
            <p class="page-lead">Classificação geral por XP acumulado em aulas, laboratórios e desafios.</p>
        </div>
    </header>

    <?php if (empty($ranking)): ?>
        <div class="empty"><strong>Ninguém pontuou ainda</strong>Resolva um desafio para abrir o ranking.</div>
    <?php else: ?>

        <?php if (count($top) >= 3): ?>
        <section class="podium" aria-label="Três primeiros colocados">
            <?php foreach ($podiumOrder as $pos => $u): ?>
                <div class="podium-spot <?= $pos === 0 ? 'first' : '' ?>">
                    <div class="podium-place"><?= $pos + 1 ?>º</div>
                    <p class="podium-name"><?= htmlspecialchars($u['name']) ?></p>
                    <div class="meta"><?= htmlspecialchars($u['level_name'] ?? 'Iniciante') ?></div>
                    <div class="xp mt-2"><?= number_format((int) $u['xp'], 0, ',', '.') ?> XP</div>
                </div>
            <?php endforeach; ?>
        </section>
        <?php endif; ?>

        <div class="panel p-0">
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Posição</th>
                            <th scope="col">Usuário</th>
                            <th scope="col">Nível</th>
                            <th scope="col" class="text-end">Resolvidos</th>
                            <th scope="col" class="text-end">XP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ranking as $i => $user): ?>
                            <tr class="<?= (int) $user['id'] === (int) $me ? 'is-me' : '' ?>">
                                <td class="rank-pos"><?= $i + 1 ?></td>
                                <td>
                                    <?= htmlspecialchars($user['name']) ?>
                                    <?php if ((int) $user['id'] === (int) $me): ?><span class="chip ms-2">Você</span><?php endif; ?>
                                </td>
                                <td class="text-secondary"><?= htmlspecialchars($user['level_name'] ?? 'Iniciante') ?></td>
                                <td class="text-end"><?= (int) $user['solved'] ?></td>
                                <td class="text-end xp"><?= number_format((int) $user['xp'], 0, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>

</main>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
