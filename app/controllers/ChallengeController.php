<?php

class ChallengeController extends Controller
{
    private Challenge $challengeModel;

    private Submission $submissionModel;

    private User $userModel;

    private Activity $activityModel;

   public function __construct()
   {
    $this->challengeModel =
        new Challenge();

    $this->submissionModel =
        new Submission();

    $this->userModel =
        new User();

    $this->activityModel =
        new Activity();
   }

    public function index(): void
    {
        Auth::requireLogin();

        $challenges =
            $this->challengeModel->getAll();

        $this->view(
            'challenges/index',
            [
                'challenges' => $challenges
            ]
        );
    }

    public function create(): void
    {
        Auth::requireAdmin();

        $this->view(
            'challenges/create'
        );
    }

    public function store(): void
    {
    Auth::requireAdmin();

    if (
        empty($_POST['title']) ||
        empty($_POST['description']) ||
        empty($_POST['difficulty']) ||
        empty($_POST['xp_reward']) ||
        empty($_POST['flag'])
    ) {

        exit('Preencha todos os campos.');
    }

    $this->challengeModel->create([
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'difficulty' => $_POST['difficulty'],
        'xp_reward' => $_POST['xp_reward'],
        'flag' => $_POST['flag']
    ]);

    $this->redirect('challenges');
  }

    public function edit(): void
    {
    Auth::requireAdmin();

    $id = (int)($_GET['id'] ?? 0);

    $challenge = $this->challengeModel
        ->findById($id);

    if (!$challenge) {

        http_response_code(404);

        exit('Desafio não encontrado.');
    }

    $this->view(
        'challenges/edit',
        [
            'challenge' => $challenge
        ]
    );
 }

    public function update(): void
    {
        Auth::requireAdmin();

        $id = (int)$_POST['id'];

        $this->challengeModel->update(
            $id,
            [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'difficulty' => $_POST['difficulty'],
                'xp_reward' => $_POST['xp_reward'],
                'flag' => $_POST['flag']
            ]
        );

        $this->redirect('challenges');
    }

    public function delete(): void
    {
        Auth::requireAdmin();

        $id = (int)$_POST['id'];

        $this->challengeModel->delete($id);

        $this->redirect('challenges');
    }

    public function show(): void
    {
    Auth::requireLogin();

    $id = (int)($_GET['id'] ?? 0);

    $challenge = $this->challengeModel
        ->findById($id);

    if (!$challenge) {

        http_response_code(404);

        exit('Desafio não encontrado.');
    }

    $this->view(
        'challenges/show',
        [
            'challenge' => $challenge
        ]
    );
 }

   public function submitFlag(): void
   {
    Auth::requireLogin();

    $challengeId =
        (int)$_POST['challenge_id'];

    $submittedFlag =
        trim($_POST['flag']);

    $challenge =
        $this->challengeModel
            ->findById(
                $challengeId
            );

    if (!$challenge) {

        exit(
            'Desafio não encontrado.'
        );
    }

    $userId = Auth::id();

    if (
        $this->challengeModel
            ->hasSolved(
                $userId,
                $challengeId
            )
    ) {

        Session::set(
            'error',
            'Você já resolveu este desafio.'
        );

        $this->redirect(
            'challenge?id='
            . $challengeId
        );
    }

    $correct =
        $submittedFlag ===
        $challenge['flag'];

    $this->submissionModel
        ->create(
            $userId,
            $challengeId,
            $submittedFlag,
            $correct
        );

    if (!$correct) {

        Session::set(
            'error',
            'Flag incorreta.'
        );

        $this->redirect(
            'challenge?id='
            . $challengeId
        );
    }

    $this->userModel->addXp(
        $userId,
        (int)$challenge['xp_reward']
    );

    $this->userModel->updateLevel(
        $userId
    );

    $userModel = new User();

    $badge = new Badge();

     $solved =
         $userModel
          ->countSolvedChallenges(
            $userId
        );

     if ($solved >= 1) {
         $badge->award($userId, 2);
     }

     if ($solved >= 5) {
         $badge->award($userId, 3);
     }

     if ($solved >= 10) {
         $badge->award($userId, 4);
     }

     $user =
    $userModel
        ->findById(
            $userId
        );

    if ($user['xp'] >= 100) {
    $badge->award($userId, 5);
    }

    if ($user['xp'] >= 500) {
    $badge->award($userId, 6);
    }

    if ($user['xp'] >= 1000) {
    $badge->award($userId, 7);
    }

    $this->activityModel->create(
        $userId,
        'DESAFIO',
        'Resolveu: '
        . $challenge['title']
    );

    Session::set(
        'success',
        'Desafio concluído!'
    );

    $this->redirect(
        'challenge?id='
        . $challengeId
    );
 }
}