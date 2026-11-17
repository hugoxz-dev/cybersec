<?php

class LessonController extends Controller
{
    private const QUIZ_XP = 20;

    private Lesson $lessonModel;

    private LessonProgress $progressModel;

    public function __construct()
    {
        $this->lessonModel = new Lesson();
        $this->progressModel = new LessonProgress();
    }

    public function show(): void
    {
        Auth::requireLogin();

        $lesson = $this->findAccessibleLesson(
            (int)($_GET['id'] ?? 0)
        );

        $this->view(
            'lessons/show',
            [
                'lesson' => $lesson,
                'quiz' => $this->lessonModel->getQuiz($lesson['id'])
            ]
        );
    }

    public function submitQuiz(): void
    {
        Auth::requireLogin();

        $lesson = $this->findAccessibleLesson(
            (int)($_POST['lesson_id'] ?? 0)
        );

        $lessonId = (int)$lesson['id'];

        $quiz = $this->lessonModel->getQuiz($lessonId);

        $correct = 0;

        foreach ($quiz as $question) {

            $answer = $_POST['question_' . $question['id']] ?? '';

            if (
                is_string($answer) &&
                strtoupper($answer) === strtoupper($question['correct_option'])
            ) {
                $correct++;
            }
        }

        $total = count($quiz);

        if ($total === 0 || $correct !== $total) {

            Session::set('error', "Você acertou {$correct}/{$total}");

            $this->redirect('lesson?id=' . $lessonId);
        }

        if ($this->progressModel->complete(Auth::id(), $lessonId)) {

            (new User())->reward(
                Auth::id(),
                self::QUIZ_XP,
                'AULA',
                'Concluiu a aula: ' . $lesson['title']
            );

            Session::set('success', 'Quiz concluído! +' . self::QUIZ_XP . ' XP');

        } else {

            Session::set(
                'success',
                'Todas certas! Você já havia concluído esta aula, então nenhum XP foi adicionado.'
            );
        }

        $this->redirect('lesson?id=' . $lessonId);
    }

    /**
     * Busca a aula e garante que a anterior da trilha foi concluída.
     * Usado tanto para ver a aula quanto para enviar o quiz.
     */
    private function findAccessibleLesson(int $id): array
    {
        $lesson = $this->lessonModel->findById($id);

        if (!$lesson) {
            throw new NotFoundException('Aula não encontrada.');
        }

        $previous = $this->lessonModel->getPreviousLesson(
            $lesson['path_id'],
            $lesson['lesson_order']
        );

        if (
            $previous &&
            !$this->progressModel->isLessonCompleted(Auth::id(), $previous['id'])
        ) {
            Session::set('error', 'Conclua a aula anterior primeiro.');

            $this->redirect('path?id=' . $lesson['path_id']);
        }

        return $lesson;
    }
}
