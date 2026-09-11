<?php

require_once '../config/config.php';

spl_autoload_register(function ($class) {

    $folders = [
        '../app/core/',
        '../app/controllers/',
        '../app/models/'
    ];

    foreach ($folders as $folder) {

        $file = $folder . $class . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

Session::start();

$router = new Router();

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

$router->get('/', ['AuthController', 'login']);

$router->get('/login', ['AuthController', 'login']);

$router->post('/login', ['AuthController', 'authenticate']);

$router->get('/register', ['AuthController', 'register']);

$router->post('/register', ['AuthController', 'store']);

$router->get('/logout', ['AuthController', 'logout']);

$router->get('/certificate', [ 'CertificateController', 'index']);

$router->post('/certificate/generate',
['CertificateController','generate']);

$router->get('/lesson', ['LessonController', 'show']);

$router->post('/lesson/submit',['LessonController', 'submitQuiz']);

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/

$router->get('/dashboard', ['DashboardController', 'index']);

/*
|--------------------------------------------------------------------------
| PERFIL
|--------------------------------------------------------------------------
*/

$router->get('/profile', ['ProfileController', 'index']);

$router->post('/profile/update', ['ProfileController', 'update']);

$router->post('/profile/password', ['ProfileController', 'changePassword']);

/*
|--------------------------------------------------------------------------
| DESAFIOS
|--------------------------------------------------------------------------
*/

$router->get('/challenges', ['ChallengeController', 'index']);

$router->get('/challenges/create', ['ChallengeController', 'create']);

$router->post('/challenges/store', ['ChallengeController', 'store']);

$router->get('/challenges/edit', ['ChallengeController', 'edit']);

$router->post('/challenges/update', ['ChallengeController', 'update']);

$router->post('/challenges/delete', ['ChallengeController', 'delete']);

$router->get('/challenge', ['ChallengeController', 'show']);

$router->post('/challenge/submit', ['ChallengeController', 'submitFlag']);

/*
|--------------------------------------------------------------------------
| TRILHAS
|--------------------------------------------------------------------------
*/

$router->get(
    '/paths',
    ['LearningPathController', 'index']
);

$router->get(
    '/path',
    ['LearningPathController', 'show']
);

/*
|--------------------------------------------------------------------------
| LABORATÓRIOS
|--------------------------------------------------------------------------
*/

$router->get(
    '/labs',
    ['LabController', 'index']
);

$router->get(
    '/lab',
    ['LabController', 'show']
);
  
$router->post(
    '/lab/submit',
    ['LabController', 'submit']
);

/*
|--------------------------------------------------------------------------
| RANKING
|--------------------------------------------------------------------------
*/

$router->get('/ranking', ['RankingController', 'index']);

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

$router->get('/admin', ['AdminController', 'dashboard']);

$router->get('/admin/users', ['AdminController', 'users']);

$router->get('/admin/challenges', ['AdminController', 'challenges']);

$router->get(
    '/admin/paths',
    ['AdminController', 'paths']
);

$router->get(
    '/admin/lessons',
    ['AdminController', 'lessons']
);

$router->get(
    '/admin/lessons/create',
    ['AdminController', 'createLesson']
);

$router->post(
    '/admin/lessons/store',
    ['AdminController', 'storeLesson']
);

$router->post(
    '/admin/lessons/delete',
    ['AdminController', 'deleteLesson']
);

$router->get(
    '/admin/questions',
    ['QuestionController', 'index']
);

$router->get(
    '/admin/questions/create',
    ['QuestionController', 'create']
);

$router->post(
    '/admin/questions/store',
    ['QuestionController', 'store']
);

$router->get(
    '/admin/questions/edit',
    ['QuestionController', 'edit']
);

$router->post(
    '/admin/questions/update',
    ['QuestionController', 'update']
);

$router->get(
    '/admin/paths/create',
    ['AdminController', 'createPath']
);

$router->post(
    '/admin/paths/store',
    ['AdminController', 'storePath']
);

$router->post(
    '/admin/paths/delete',
    ['AdminController', 'deletePath']
);

/*
|--------------------------------------------------------------------------
| ADMIN LABORATÓRIOS
|--------------------------------------------------------------------------
*/

$router->get(
    '/admin/labs',
    ['AdminController', 'labs']
);

$router->get(
    '/admin/labs/create',
    ['AdminController', 'createLab']
);

$router->post(
    '/admin/labs/store',
    ['AdminController', 'storeLab']
);

$router->get(
    '/admin/labs/edit',
    ['AdminController', 'editLab']
);

$router->post(
    '/admin/labs/update',
    ['AdminController', 'updateLab']
);

$router->post(
    '/admin/labs/delete',
    ['AdminController', 'deleteLab']
);

$router->dispatch();
