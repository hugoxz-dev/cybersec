<?php

class AuthController extends Controller
{
    // Tentativas de login erradas permitidas por janela.
    private const LOGIN_MAX_PER_ACCOUNT = 5;
    private const LOGIN_MAX_PER_IP = 20;
    private const LOGIN_WINDOW = 900; // 15 min

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
        $error = (new Validator($_POST))
            ->required('name', 'Nome')
            ->max('name', 100, 'Nome')
            ->required('email', 'E-mail')
            ->email('email', 'E-mail')
            ->max('email', 150, 'E-mail')
            ->required('password', 'Senha')
            ->min('password', 6, 'A senha')
            ->max('password', 72, 'A senha')
            ->firstError();

        if ($error) {
            Session::set('error', $error);
            $this->redirect('register');
        }

        $name = trim($_POST['name']);
        $email = mb_strtolower(trim($_POST['email']));

        if ($this->userModel->findByEmail($email)) {
            Session::set('error', 'E-mail já cadastrado.');
            $this->redirect('register');
        }

        $this->userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => $_POST['password']
        ]);

        $userCreated = $this->userModel->findByEmail($email);

        (new Activity())->create(
            $userCreated['id'],
            'CADASTRO',
            'Conta criada.'
        );

        Session::set('success', 'Conta criada com sucesso.');

        $this->redirect('login');
    }

    public function authenticate(): void
    {
        $email = mb_strtolower(trim((string)($_POST['email'] ?? '')));
        $password = (string)($_POST['password'] ?? '');

        $ip = RateLimiter::clientIp();
        $accountKey = $ip . '|' . $email;

        if (
            RateLimiter::tooMany('login', $accountKey, self::LOGIN_MAX_PER_ACCOUNT, self::LOGIN_WINDOW) ||
            RateLimiter::tooMany('login-ip', $ip, self::LOGIN_MAX_PER_IP, self::LOGIN_WINDOW)
        ) {
            Session::set(
                'error',
                'Muitas tentativas de login. Aguarde 15 minutos e tente de novo.'
            );

            $this->redirect('login');
        }

        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {

            RateLimiter::hit('login', $accountKey);
            RateLimiter::hit('login-ip', $ip);

            Session::set('error', 'Credenciais inválidas.');

            $this->redirect('login');
        }

        RateLimiter::clear('login', $accountKey);

        // Novo ID de sessão a cada login (evita session fixation).
        Session::regenerate();

        Session::set('user', [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ]);

        (new Activity())->create(
            $user['id'],
            'LOGIN',
            'Usuário realizou login.'
        );

        (new Badge())->award($user['id'], Badge::FIRST_LOGIN);

        $this->redirect('dashboard');
    }

    public function logout(): void
    {
        Session::destroy();

        $this->redirect('login');
    }
}
