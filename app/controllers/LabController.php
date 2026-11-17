<?php

class LabController extends Controller
{
    private Lab $labModel;

    public function __construct()
    {
        $this->labModel =
            new Lab();
    }

    public function index(): void
    {
    Auth::requireLogin();

    $category =
    $_GET['category']
    ?? null;

   if ($category) {

    $labs =
        $this->labModel
            ->getByCategory(
                $category
            );

   } else {

    $labs =
        $this->labModel
            ->getAll();
   }

    $progressModel =
        new LabProgress();

    $completedLabs =
        $progressModel
            ->countCompleted(
                Auth::id()
            );

    $totalLabs =
        $this->labModel
            ->countAll();

    $this->view(
        'labs/index',
        [
            'labs' => $labs,
            'progressModel' => $progressModel,
            'completedLabs' => $completedLabs,
            'totalLabs' => $totalLabs
        ]
    );
    }


    public function show(): void
    {
        Auth::requireLogin();

        $lab = $this->findLab((int)($_GET['id'] ?? 0));

        $this->view(
            'labs/show',
            [
                'lab' => $lab
            ]
        );
    }

    public function submit(): void
    {
        Auth::requireLogin();

        $lab = $this->findLab((int)($_POST['lab_id'] ?? 0));

        $labId = (int)$lab['id'];
        $userId = Auth::id();
        $limiterKey = $userId . ':' . $labId;

        if (RateLimiter::tooMany('lab', $limiterKey, 10, 60)) {

            Session::set(
                'error',
                'Muitas tentativas. Aguarde um minuto e tente de novo.'
            );

            $this->redirect('lab?id=' . $labId);
        }

        $answer = trim((string)($_POST['answer'] ?? ''));

        $correct = hash_equals(
            mb_strtolower(trim($lab['answer'])),
            mb_strtolower($answer)
        );

        if (!$correct) {

            RateLimiter::hit('lab', $limiterKey);

            Session::set('error', 'Resposta incorreta.');

            $this->redirect('lab?id=' . $labId);
        }

        if ((new LabProgress())->complete($userId, $labId)) {

            (new User())->reward(
                $userId,
                (int)$lab['xp_reward'],
                'LABORATÓRIO',
                'Concluiu o laboratório: ' . $lab['title']
            );

            Session::set(
                'success',
                'Laboratório concluído! +' . (int)$lab['xp_reward'] . ' XP'
            );

        } else {

            Session::set(
                'success',
                'Resposta correta! Você já havia concluído este laboratório, então nenhum XP foi adicionado.'
            );
        }

        $this->redirect('lab?id=' . $labId);
    }

    private function findLab(int $id): array
    {
        $lab = $this->labModel->findById($id);

        if (!$lab) {
            throw new NotFoundException('Laboratório não encontrado.');
        }

        return $lab;
    }
}
