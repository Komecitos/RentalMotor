<?php
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new User($db);
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->login($username, $password);
            if ($user) {
                $_SESSION['user'] = $user;
                header("Location: index.php?page=dashboard");
                exit;
            } else {
                $error = "Login gagal! Username atau password salah.";
            }
        }

        include __DIR__ . '/../views/login.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            // Validasi sederhana
            if (empty($username) || empty($password) || empty($confirmPassword)) {
                $error = "Semua field harus diisi.";
            } elseif ($password !== $confirmPassword) {
                $error = "Password dan konfirmasi password tidak cocok.";
            } else {
                $success = $this->userModel->register($username, $password);
                if ($success) {
                    header("Location: index.php?page=login");
                    exit;
                } else {
                    $error = "Registrasi gagal. Username mungkin sudah digunakan.";
                }
            }
        }

        include __DIR__ . '/../views/register.php';
    }


    public function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        header("Location: index.php?page=login");
        exit;
    }
}
