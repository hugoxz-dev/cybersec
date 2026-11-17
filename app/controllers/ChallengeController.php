<?php

class ChallengeController extends Controller
{
    private const DIFFICULTIES = ['Easy', 'Medium', 'Hard'];

    private Challenge $challengeModel;

    private Submission $submissionModel;

    public function __construct()
    {
        $this->challengeModel = new Challenge();
        $this->submissionModel = new Submission();
    }

    public function index(): void
    {
        Auth::requireLogin();

        $this->view(
            'challenges/index',
            [
                'challenges' => $this->challengeModel->getAll()
            ]
        );
    }

    public function create(): void
    {
        Auth::requireAdmin();

        $this->view('challenges/create');
    }

    public function store(): void
    {
        Auth::requireAdmin();

        $error = $this->validate($_POST);

        if ($error) {
            Session::set('error', $error);
            $this->redirect('challenges/create');
        }

        $this->challengeModel->create($this->formData($_POST));

        Session::set('success', 'Desafio criado.');

        $this->redirect('challenges');
    }

    public function edit(): void
    {
        Auth::requireAdmin();

        $this->view(
            'challenges/edit',
            [
                'challenge' => $this->findChallenge((int)($_GET['id'] ?? 0))
            ]
        );
    }

    public function update(): void
    {
        Auth::requireAdmin();

        $challenge = $this->findChallenge((int)($_POST['id'] ?? 0));

        $error = $this->validate($_POST);

        if ($error) {
            Session::set('error', $error);
            $this->redirect('challenges/edit?id=' . $challenge['id']);
        }

        $this->challengeModel->update(
            (int)$challenge['id'],
            $this->formData($_POST)
        );

        Session::set('success', 'Desafio atualizado.');

        $this->redirect('challenges');
    }

    public function delete(): void
    {
        Auth::requireAdmin();

        $this->challengeModel->delete((int)($_POST['id'] ?? 0));

        $this->redirect('challenges');
    }

    public function show(): void
    {
        Auth::requireLogin();

        $this->view(
            'challenges/show',
            [
                'challenge' => $this->findChallenge((int)($_GET['id'] ?? 0))
            ]
        );
    }

    public function submitFlag(): void
    {
        Auth::requireLogin();

        $challenge = $this->findChallenge((int)($_POST['challenge_id'] ?? 0));

        $challengeId = (int)$challenge['id'];
        $userId = Auth::id();
        $back = 'challenge?id=' . $challengeId;
        $limiterKey = $userId . ':' . $challengeId;

        if ($this->challengeModel->hasSolved($userId, $challengeId)) {
            Session::set('error', 'Você já resolveu este desafio.');
            $this->redirect($back);
        }

        if (RateLimiter::tooMany('flag', $limiterKey, 10, 60)) {
            Session::set('error', 'Muitas tentativas. Aguarde um minuto e tente de novo.');
            $this->redirect($back);
        }

        $submittedFlag = trim((string)($_POST['flag'] ?? ''));

        $correct = hash_equals((string)$challenge['flag'], $submittedFlag);

        $this->submissionModel->create(
            $userId,
            $challengeId,
            mb_substr($submittedFlag, 0, 255),
            $correct
        );

        if (!$correct) {
            RateLimiter::hit('flag', $limiterKey);
            Session::set('error', 'Flag incorreta.');
            $this->redirect($back);
        }

        // Só o primeiro registro ganha XP, mesmo com envios simultâneos.
        if (!$this->challengeModel->markSolved($userId, $challengeId)) {
            Session::set('error', 'Você já resolveu este desafio.');
            $this->redirect($back);
        }

        (new User())->reward(
            $userId,
            (int)$challenge['xp_reward'],
            'DESAFIO',
            'Resolveu: ' . $challenge['title']
        );

        Session::set('success', 'Desafio concluído!');

        $this->redirect($back);
    }

    private function findChallenge(int $id): array
    {
        $challenge = $this->challengeModel->findById($id);

        if (!$challenge) {
            throw new NotFoundException('Desafio não encontrado.');
        }

        return $challenge;
    }

    private function validate(array $input): ?string
    {
        return (new Validator($input))
            ->required('title', 'Título')
            ->max('title', 150, 'Título')
            ->required('description', 'Descrição')
            ->in('difficulty', self::DIFFICULTIES, 'Dificuldade')
            ->integer('xp_reward', 1, 10000, 'XP')
            ->required('flag', 'Flag')
            ->max('flag', 255, 'Flag')
            ->firstError();
    }

    private function formData(array $input): array
    {
        return [
            'title' => trim($input['title']),
            'description' => trim($input['description']),
            'difficulty' => $input['difficulty'],
            'xp_reward' => (int)$input['xp_reward'],
            'flag' => trim($input['flag'])
        ];
    }
}
