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

        $id =
            (int)($_GET['id'] ?? 0);

        $lab =
            $this->labModel
                ->findById($id);

        if (!$lab) {

            throw new Exception(
                'Laboratório não encontrado.'
            );
        }

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

    $labId =
        (int)($_POST['lab_id'] ?? 0);

    $answer =
        trim(
            $_POST['answer'] ?? ''
        );

    $lab =
        $this->labModel
            ->findById($labId);

    if (!$lab) {

        throw new Exception(
            'Laboratório não encontrado.'
        );
    }

    $correct =
        strtolower($answer) ===
        strtolower(
            trim($lab['answer'])
        );

    if (!$correct) {

        Session::set(
            'error',
            'Resposta incorreta.'
        );

        header(
            'Location: ' .
            BASE_URL .
            '/lab?id=' .
            $labId
        );

        exit;
    }

    $progress =
        new LabProgress();

    if (
        !$progress->isCompleted(
            Auth::id(),
            $labId
        )
    ) {

        $progress->complete(
            Auth::id(),
            $labId
        );

        $user =
            new User();

        $user->addXp(
            Auth::id(),
            $lab['xp_reward']
        );

        $user->updateLevel(
            Auth::id()
        );
    }

    Session::set(
        'success',
        'Laboratório concluído! +' .
        $lab['xp_reward'] .
        ' XP'
    );

    header(
        'Location: ' .
        BASE_URL .
        '/lab?id=' .
        $labId
    );

    exit;
   }

}