<?php

class ProfileController extends Controller
{
    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index(): void
    {
    Auth::requireLogin();

    $user = $this->userModel->findById(
        Auth::id()
    );

    $badgeModel = new Badge();

    $badges = $badgeModel->getUserBadges(
        Auth::id()
    );

    $this->view(
        'profile/index',
        [
            'user' => $user,
            'badges' => $badges
        ]
    );
    }

    public function update(): void
    {
        Auth::requireLogin();

        $id = Auth::id();

        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if (
            empty($name) ||
            empty($email)
        ) {

            Session::set(
                'error',
                'Preencha todos os campos.'
            );

            $this->redirect('profile');
        }

        if (
            !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )
        ) {

            Session::set(
                'error',
                'Email inválido.'
            );

            $this->redirect('profile');
        }

        if (
            $this->userModel->emailExists(
                $email,
                $id
            )
        ) {

            Session::set(
                'error',
                'Email já utilizado.'
            );

            $this->redirect('profile');
        }

        $photo = null;

        if (
    isset($_FILES['photo']) &&
    $_FILES['photo']['error'] === 0
) {

    $allowedExtensions = [
        'jpg',
        'jpeg',
        'png',
        'webp'
    ];

    $extension = strtolower(
        pathinfo(
            $_FILES['photo']['name'],
            PATHINFO_EXTENSION
        )
    );

    if (!in_array($extension, $allowedExtensions)) {

        Session::set(
            'error',
            'Formato de imagem inválido.'
        );

        $this->redirect('profile');
    }

    $photo = uniqid()
        . '.'
        . $extension;

    move_uploaded_file(
        $_FILES['photo']['tmp_name'],
        UPLOAD_PATH . $photo
    );
}

        $this->userModel->updateProfile(
            $id,
            $name,
            $email,
            $photo
        );

         $activity = new Activity();

         $activity->create(
             $id,
             'PERFIL',
             'Perfil atualizado.'
         );        

        $user = $this->userModel->findById($id);

        Session::set('user', [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ]);

        Session::set(
            'success',
            'Perfil atualizado.'
        );

        $this->redirect('profile');
    }

    public function changePassword(): void
    {
        Auth::requireLogin();

        $password =
            $_POST['password'] ?? '';

        $confirm =
            $_POST['confirm_password'] ?? '';

        if (
            strlen($password) < 6
        ) {

            Session::set(
                'error_password',
                'Senha muito curta.'
            );

            $this->redirect('profile');
        }

        if (
            $password !== $confirm
        ) {

            Session::set(
                'error_password',
                'As senhas não coincidem.'
            );

            $this->redirect('profile');
        }

        $this->userModel->updatePassword(
            Auth::id(),
            $password
        );

         $activity = new Activity();

         $activity->create(
             Auth::id(),
             'SENHA',
             'Senha alterada.'
        );

        Session::set(
            'success_password',
            'Senha alterada.'
        );

        $this->redirect('profile');
    }
}