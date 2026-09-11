<?php

class LearningPathController extends Controller
{
    private LearningPath $pathModel;

    public function __construct()
    {
        $this->pathModel = new LearningPath();
    }

    public function index(): void
    {
        Auth::requireLogin();

        $paths = $this->pathModel
            ->getAll();

        $this->view(
            'paths/index',
            [
                'paths' => $paths
            ]
        );
    }

    public function show(): void
{
    Auth::requireLogin();

    $id =
        (int)($_GET['id'] ?? 0);

    $path =
        $this->pathModel
            ->findById($id);

    if (!$path) {

        throw new Exception(
            'Trilha não encontrada.'
        );
    }

    $lessons =
        $this->pathModel
            ->getLessons($id);
    
     $lessonModel = new Lesson();        

    $progress =
        $this->pathModel
            ->getProgress(
                $id,
                Auth::id()
            );

    $progressModel =
        new LessonProgress();

    $this->view(
        'paths/show',
        [
            'path' => $path,
            'lessons' => $lessons,
            'progress' => $progress,
            'progressModel' => $progressModel,
            'lessonModel' => $lessonModel
        ]
    );
 }

}