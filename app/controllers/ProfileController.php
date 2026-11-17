<?php

class ProfileController extends Controller
{
    // Tipo real do arquivo (lido do conteúdo) => extensão salva.
    private const PHOTO_TYPES = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp'
    ];

    private User $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index(): void
    {
        Auth::requireLogin();

        $this->view(
            'profile/index',
            [
                'user' => $this->userModel->findById(Auth::id()),
                'badges' => (new Badge())->getUserBadges(Auth::id())
            ]
        );
    }

    public function update(): void
    {
        Auth::requireLogin();

        $id = Auth::id();

        $error = (new Validator($_POST))
            ->required('name', 'Nome')
            ->max('name', 100, 'Nome')
            ->required('email', 'E-mail')
            ->email('email', 'E-mail')
            ->max('email', 150, 'E-mail')
            ->firstError();

        if ($error) {
            Session::set('error', $error);
            $this->redirect('profile');
        }

        $name = trim($_POST['name']);
        $email = mb_strtolower(trim($_POST['email']));

        if ($this->userModel->emailExists($email, $id)) {
            Session::set('error', 'Email já utilizado.');
            $this->redirect('profile');
        }

        $oldPhoto = $this->userModel->findById($id)['photo'] ?? null;

        $photo = $this->storeUploadedPhoto($_FILES['photo'] ?? null);

        $this->userModel->updateProfile($id, $name, $email, $photo);

        if ($photo && $oldPhoto) {
            $this->deletePhoto($oldPhoto);
        }

        (new Activity())->create($id, 'PERFIL', 'Perfil atualizado.');

        $user = $this->userModel->findById($id);

        Session::set('user', [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ]);

        Session::set('success', 'Perfil atualizado.');

        $this->redirect('profile');
    }

    public function changePassword(): void
    {
        Auth::requireLogin();

        $error = (new Validator($_POST))
            ->required('password', 'Senha')
            ->min('password', 6, 'A senha')
            ->max('password', 72, 'A senha')
            ->matches('password', 'confirm_password', 'As senhas não coincidem.')
            ->firstError();

        if ($error) {
            Session::set('error_password', $error);
            $this->redirect('profile');
        }

        $this->userModel->updatePassword(Auth::id(), $_POST['password']);

        (new Activity())->create(Auth::id(), 'SENHA', 'Senha alterada.');

        Session::set('success_password', 'Senha alterada.');

        $this->redirect('profile');
    }

    /**
     * Valida e salva a foto enviada. Retorna o nome do arquivo salvo,
     * null se nenhuma foto foi enviada, ou redireciona com erro.
     */
    private function storeUploadedPhoto(?array $file): ?string
    {
        if (!$file || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        $maxMb = UPLOAD_MAX_BYTES / 1024 / 1024;

        if (in_array($file['error'], [UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE], true)) {
            $this->failPhoto("A imagem deve ter no máximo {$maxMb} MB.");
        }

        if ($file['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'])) {
            $this->failPhoto('Não foi possível enviar a imagem. Tente de novo.');
        }

        if ($file['size'] > UPLOAD_MAX_BYTES) {
            $this->failPhoto("A imagem deve ter no máximo {$maxMb} MB.");
        }

        // O tipo vem do conteúdo do arquivo, não do nome que o usuário mandou.
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);

        if (
            !isset(self::PHOTO_TYPES[$mime]) ||
            @getimagesize($file['tmp_name']) === false
        ) {
            $this->failPhoto('Formato de imagem inválido. Use JPG, PNG ou WEBP.');
        }

        $photo = bin2hex(random_bytes(16)) . '.' . self::PHOTO_TYPES[$mime];

        if (!move_uploaded_file($file['tmp_name'], UPLOAD_PATH . $photo)) {
            $this->failPhoto('Não foi possível salvar a imagem. Tente de novo.');
        }

        return $photo;
    }

    private function failPhoto(string $message): never
    {
        Session::set('error', $message);
        $this->redirect('profile');
    }

    private function deletePhoto(string $photo): void
    {
        $path = UPLOAD_PATH . basename($photo);

        if (is_file($path)) {
            @unlink($path);
        }
    }
}
