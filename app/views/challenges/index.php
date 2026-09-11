<?php
require_once __DIR__ . '/../layouts/header.php';
require_once __DIR__ . '/../layouts/navbar.php';
require_once __DIR__ . '/../layouts/sidebar.php';
?>

<div class="main-content">

<?php

$totalChallenges =
    count($challenges);

$solvedCount = 0;

$model =
    new Challenge();

foreach($challenges as $c)
{
    if(
        $model->hasSolved(
            Auth::id(),
            $c['id']
        )
    )
    {
        $solvedCount++;
    }
}

$progress =
    $totalChallenges > 0
    ? round(
        ($solvedCount / $totalChallenges)
        * 100
      )
    : 0;

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="mb-1">
            ⚔️ Desafios
        </h2>
        
         <div class="mt-3">

<p>

Desafios concluídos:

<strong>

<?= $solvedCount ?>

/

<?= $totalChallenges ?>

</strong>

</p>

<div class="progress">

<div
class="progress-bar bg-success"
style="width: <?= $progress ?>%">

<?= $progress ?>%

</div>

</div>

</div>
 
        <p class="text-secondary mb-0">
            Teste seus conhecimentos e ganhe XP.
        </p>

    </div>

    <?php if(Auth::isAdmin()): ?>

        <a
        href="<?= BASE_URL ?>/challenges/create"
        class="btn btn-success">

            Novo Desafio

        </a>

    <?php endif; ?>

</div>

<div class="row">

<?php foreach($challenges as $challenge): ?>

<?php

$challengeModel =
    new Challenge();

$solved =
    $challengeModel->hasSolved(
        Auth::id(),
        $challenge['id']
    );

?>

<div class="col-lg-4 col-md-6 mb-4">

    <div class="card challenge-card h-100">

        <div class="card-body d-flex flex-column">

            <div class="d-flex justify-content-between mb-3">

                <span class="badge
                <?=
                $challenge['difficulty'] === 'Fácil'
                    ? 'badge-easy'
                    : (
                        $challenge['difficulty'] === 'Médio'
                        ? 'badge-medium'
                        : 'badge-hard'
                    );
                ?>">

                    <?= htmlspecialchars(
                        $challenge['difficulty']
                    ) ?>

                </span>

                <span class="text-secondary">

                    #<?= $challenge['id'] ?>

                </span>

            </div>

            <h4 class="mb-3">

                <?= htmlspecialchars(
                    $challenge['title']
                ) ?>

            </h4>

            <?php if($solved): ?>

<div class="mb-3">

<span
class="badge bg-success">

✔ Resolvido

</span>

</div>

<?php else: ?>

<div class="mb-3">

<span
class="badge bg-warning text-dark">

⚔ Disponível

</span>

</div>

<?php endif; ?>

            <div class="mb-4">

                <span class="challenge-xp">

                    ⭐ <?= $challenge['xp_reward'] ?> XP

                </span>

            </div>

            <div class="mt-auto">

                <a
                href="<?= BASE_URL ?>/challenge?id=<?= $challenge['id'] ?>"
                class="btn btn-primary w-100 mb-2">

                    <?= $solved
                    ? 'Revisar Desafio'
                    : 'Resolver Desafio'
                     ?>

                </a>

                <?php if(Auth::isAdmin()): ?>

                    <div class="d-flex gap-2">

                        <a
                        href="<?= BASE_URL ?>/challenges/edit?id=<?= $challenge['id'] ?>"
                        class="btn btn-warning flex-fill">

                            Editar

                        </a>

                        <form
                        method="POST"
                        action="<?= BASE_URL ?>/challenges/delete"
                        class="flex-fill">

                            <input
                            type="hidden"
                            name="id"
                            value="<?= $challenge['id'] ?>">

                            <button
                            type="submit"
                            class="btn btn-danger w-100"
                            onclick="return confirm('Deseja excluir este desafio?');">

                                Excluir

                            </button>

                        </form>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>

<?php endforeach; ?>

</div>

</div>

<?php
require_once __DIR__ . '/../layouts/footer.php';
?>