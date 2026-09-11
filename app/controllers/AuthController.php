<?php

class AuthController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login(): void
    {
        if (Auth::check()) {
            $this->redirect('dashboard');
        }

        $this->view('auth/login');
    }

    public function register(): void
    {
        if (Auth::check()) {
            $this->redirect('dashboard');
        }

        $this->view('auth/register');
    }

    public function store(): void
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (
            empty($name) ||
            empty($email) ||
            empty($password)
        ) {

            Session::set(
                'error',
                'Preencha todos os campos.'
            );

            $this->redirect('register');
        }

        if (strlen($password) < 6) {

    Session::set(
        'error',
        'A senha deve possuir no mínimo 6 caracteres.'
    );

    $this->redirect('register');
}

        if ($this->userModel->findByEmail($email)) {

            Session::set(
                'error',
                'E-mail já cadastrado.'
            );

            $this->redirect('register');
        }

       $this->userModel->create([
    'name' => $name,
    'email' => $email,
    'password' => $password
]);

     $userCreated = $this->userModel->findByEmail(
    $email
);

     $activity = new Activity();

     $activity->create(
    $userCreated['id'],
    'CADASTRO',
    'Conta criada.'
);

     Session::set(
    'success',
    'Conta criada com sucesso.'
);

     $this->redirect('login');
    }

    public function authenticate(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        $user = $this->userModel->findByEmail($email);

        if (
            !$user ||
            !password_verify(
                $password,
                $user['password']
            )
        ) {

            Session::set(
                'error',
                'Credenciais inválidas.'
            );

            $this->redirect('login');
        }

        Session::set('user', [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ]);

         $activity = new Activity();

         $activity->create(
           $user['id'],
           'LOGIN',
           'Usuário realizou login.'
         );

         $badge = new Badge();

         $badge->award(
           $user['id'],
           1
         );

        $this->redirect('dashboard');
    }

    public function logout(): void
    {
        Session::destroy();

        header(
            'Location: ' . BASE_URL . '/login'
        );

        exit;
    }
}