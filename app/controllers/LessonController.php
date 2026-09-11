<?php

class LessonController extends Controller
{
    private Lesson $lessonModel;

    public function __construct()
    {
        $this->lessonModel =
            new Lesson();
    }

    public function show(): void
    {
        Auth::requireLogin();

        $id = (int)($_GET['id'] ?? 0);

        $lesson = $this->lessonModel
            ->findById($id);

            $progressModel =
    new LessonProgress();

$previousLesson =
    $this->lessonModel
        ->getPreviousLesson(
            $lesson['path_id'],
            $lesson['lesson_order']
        );

if ($previousLesson) {

    $completed =
        $progressModel
            ->isLessonCompleted(
                Auth::id(),
                $previousLesson['id']
            );

    if (!$completed) {

        Session::set(
            'error',
            'Conclua a aula anterior primeiro.'
        );

        header(
            'Location: ' .
            BASE_URL .
            '/path?id=' .
            $lesson['path_id']
        );

        exit;
    }
}

        if (!$lesson) {

            throw new Exception(
                'Aula não encontrada.'
            );
        }

        $quiz = $this->lessonModel
            ->getQuiz($id);

        $this->view(
            'lessons/show',
            [
                'lesson' => $lesson,
                'quiz' => $quiz
            ]
        );
    }

    public function submitQuiz(): void
    {
      Auth::requireLogin();

      $lessonId =
         (int)($_POST['lesson_id'] ?? 0);

      $quiz = $this->lessonModel
        ->getQuiz($lessonId);

      $correct = 0;

      foreach ($quiz as $question) {

         $answer =
            $_POST[
                'question_' .
                $question['id']
            ] ?? '';

         if (
            strtoupper($answer) ===
            strtoupper(
                $question['correct_option']
            )
         ) {
            $correct++;
         }
     }

     $total = count($quiz);

     if (
        $total > 0 &&
        $correct === $total
     ) {

         $progress =
            new LessonProgress();

         $progress->complete(
            Auth::id(),
            $lessonId
         );

         $user =
            new User();

         $user->addXp(
            Auth::id(),
            20
         );

         $user->updateLevel(
            Auth::id()
         );
 
         Session::set(
            'success',
            'Quiz concluído! +20 XP'
         );
     }
     else {

         Session::set(
            'error',
            "Você acertou {$correct}/{$total}"
         );
     }

     header(
        'Location: ' .
        BASE_URL .
        '/lesson?id=' .
        $lessonId
     );

     exit;
 }

}