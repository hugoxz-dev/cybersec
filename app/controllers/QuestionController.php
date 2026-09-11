<?php

class QuestionController extends Controller
{
    private LearningQuestion $questionModel;

    public function __construct()
    {
        $this->questionModel =
            new LearningQuestion();
    }

    public function index(): void
    {
        Auth::requireAdmin();

        $lessonId =
            (int)($_GET['lesson_id'] ?? 0);

        $questions =
            $this->questionModel
                ->getByLesson($lessonId);

        $this->view(
            'admin/questions/index',
            [
                'lessonId' => $lessonId,
                'questions' => $questions
            ]
        );
    }

    public function create(): void
    {
       Auth::requireAdmin();

       $lessonId =
        (int)($_GET['lesson_id'] ?? 0);

       $this->view(
        'admin/questions/create',
        [
            'lessonId' => $lessonId
        ]
      );
    }

    public function store(): void
    {
        Auth::requireAdmin();

         $question =
        trim($_POST['question']);

        $optionA =
        trim($_POST['option_a']);

        $optionB =
        trim($_POST['option_b']);

        $optionC =
        trim($_POST['option_c']);

        $optionD =
        trim($_POST['option_d']);

        $correctOption =
        $_POST['correct_option'];

        $lessonId =
        (int)$_POST['lesson_id'];

        $this->questionModel->create(
         [
            'lesson_id' => $lessonId,
            'question' => $question,
            'option_a' => $optionA,
            'option_b' => $optionB,
            'option_c' => $optionC,
            'option_d' => $optionD,
            'correct_option' => $correctOption
         ]
      );
 
     header(
        'Location: ' .
        BASE_URL .
        '/admin/questions?lesson_id=' .
        $lessonId
    );

    exit;
 }

 public function edit(): void
 {
    Auth::requireAdmin();

    $id =
        (int)($_GET['id'] ?? 0);

    $question =
        $this->questionModel
            ->findById($id);

    if(!$question) {

        throw new Exception(
            'Pergunta não encontrada.'
        );
    }

    $this->view(
        'admin/questions/edit',
        [
            'question' => $question
        ]
    );
 }

 public function update(): void
{
    Auth::requireAdmin();

    $id =
        (int)$_POST['id'];

    $question =
        $this->questionModel
            ->findById($id);

    if(!$question) {

        throw new Exception(
            'Pergunta não encontrada.'
        );
    }

    $this->questionModel->update(
        $id,
        [
            'question' => $_POST['question'],
            'option_a' => $_POST['option_a'],
            'option_b' => $_POST['option_b'],
            'option_c' => $_POST['option_c'],
            'option_d' => $_POST['option_d'],
            'correct_option' => $_POST['correct_option']
        ]
    );

    header(
        'Location: ' .
        BASE_URL .
        '/admin/questions?lesson_id=' .
        $question['lesson_id']
    );

    exit;
 }

}