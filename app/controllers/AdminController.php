<?php

class AdminController extends Controller
{
    private Admin $adminModel;

    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    public function dashboard(): void
 {
    Auth::requireAdmin();

    $stats =
        $this->adminModel
            ->getStats();

    $recentUsers =
        $this->adminModel
            ->getRecentUsers();

    $topChallenges =
        $this->adminModel
            ->getTopChallenges();

    $this->view(
        'admin/dashboard',
        [
            'stats' => $stats,
            'recentUsers' => $recentUsers,
            'topChallenges' => $topChallenges
        ]
    );
    }

    public function users(): void
    {
        Auth::requireAdmin();

        $users = Database::getInstance()
            ->query("SELECT * FROM users")
            ->fetchAll();

        $this->view(
            'admin/users',
            [
                'users' => $users
            ]
        );
    }

    public function challenges(): void
    {
        Auth::requireAdmin();

        $challenges = Database::getInstance()
            ->query("SELECT * FROM challenges")
            ->fetchAll();

        $this->view(
            'admin/challenges',
            [
                'challenges' => $challenges
            ]
        );
    }

    public function paths(): void
    {
    Auth::requireAdmin();

    $pathModel = new LearningPath();

    $paths = $pathModel->getAll();

    $this->view(
        'admin/paths/index',
        [
            'paths' => $paths
        ]
    );
    }

    public function createPath(): void
    {
    Auth::requireAdmin();

    $this->view(
        'admin/paths/create'
    );
    } 

    public function storePath(): void
    {
    Auth::requireAdmin();

    $title =
        trim($_POST['title']);

    $description =
        trim($_POST['description']);

    $sql = "
        INSERT INTO learning_paths
        (
            title,
            description
        )
        VALUES
        (
            :title,
            :description
        )
    ";

    Database::getInstance()
        ->prepare($sql)
        ->execute([
            ':title' => $title,
            ':description' => $description
        ]);

    header(
        'Location: ' .
        BASE_URL .
        '/admin/paths'
    );

    exit;
    }

    public function deletePath(): void
    {
    Auth::requireAdmin();

    $id =
        (int)($_POST['id'] ?? 0);

    $sql = "
        DELETE FROM learning_paths
        WHERE id = :id
    ";

    Database::getInstance()
        ->prepare($sql)
        ->execute([
            ':id' => $id
        ]);

    header(
        'Location: ' .
        BASE_URL .
        '/admin/paths'
    );

    exit;
    }

     public function lessons(): void
    {
    Auth::requireAdmin();

    $pathId =
        (int)($_GET['path_id'] ?? 0);

    $pathModel =
        new LearningPath();

    $path =
        $pathModel->findById($pathId);

    $lessons =
        $pathModel->getLessonsAdmin(
            $pathId
        );

    $this->view(
        'admin/lessons/index',
        [
            'path' => $path,
            'lessons' => $lessons
        ]
    );
   }

    public function createLesson(): void
   {
    Auth::requireAdmin();

    $pathId =
        (int)($_GET['path_id'] ?? 0);

    $this->view(
        'admin/lessons/create',
        [
            'pathId' => $pathId
        ]
    );
    }

    public function storeLesson(): void
   {
    Auth::requireAdmin();

    $pathModel =
        new LearningPath();

    $pathModel->createLesson([
        'path_id' =>
            $_POST['path_id'],

        'title' =>
            $_POST['title'],

        'content' =>
            $_POST['content'],

        'lesson_order' =>
            $_POST['lesson_order']
    ]);

    header(
        'Location: ' .
        BASE_URL .
        '/admin/lessons?path_id=' .
        $_POST['path_id']
    );

    exit;
    }

    public function deleteLesson(): void
    {
    Auth::requireAdmin();

    $lessonId =
        (int)$_POST['id'];

    $pathId =
        (int)$_POST['path_id'];

    $pathModel =
        new LearningPath();

    $pathModel->deleteLesson(
        $lessonId
    );

    header(
        'Location: ' .
        BASE_URL .
        '/admin/lessons?path_id=' .
        $pathId
    );

    exit;
    }

    public function labs(): void
    {
    Auth::requireAdmin();

    $labModel = new Lab();

    $labs = $labModel->getAll();

    $this->view(
        'admin/labs/index',
        [
            'labs' => $labs
        ]
    );
    }

    public function createLab(): void
    {
    Auth::requireAdmin();

    $this->view(
        'admin/labs/create'
    );
    }

    public function storeLab(): void
    {
    Auth::requireAdmin();

    $labModel = new Lab();

    $labModel->create([
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'category' => $_POST['category'],
        'difficulty' => $_POST['difficulty'],
        'xp_reward' => $_POST['xp_reward'],
        'material' => $_POST['material'],
        'question' => $_POST['question'],
        'answer' => $_POST['answer']
    ]);

    Session::set(
        'success',
        'Laboratório criado com sucesso.'
    );

    header(
        'Location: ' .
        BASE_URL .
        '/admin/labs'
    );

    exit;
    }

    public function editLab(): void
    {
    Auth::requireAdmin();

    $id =
        (int)($_GET['id'] ?? 0);

    $labModel = new Lab();

    $lab =
        $labModel
            ->findById($id);

    if (!$lab) {

        throw new Exception(
            'Laboratório não encontrado.'
        );
    }

    $this->view(
        'admin/labs/edit',
        [
            'lab' => $lab
        ]
    );
    }

    public function updateLab(): void
    {
    Auth::requireAdmin();

    $id =
        (int)$_POST['id'];

    $labModel = new Lab();

    $labModel->update(
        $id,
        $_POST
    );

    Session::set(
        'success',
        'Laboratório atualizado.'
    );

    header(
        'Location: ' .
        BASE_URL .
        '/admin/labs'
    );

    exit;
    }

    public function deleteLab(): void
    {
    Auth::requireAdmin();

    $id =
        (int)$_POST['id'];

    $labModel = new Lab();

    $labModel->delete($id);

    Session::set(
        'success',
        'Laboratório removido.'
    );

    header(
        'Location: ' .
        BASE_URL .
        '/admin/labs'
    );

    exit;
    }

}