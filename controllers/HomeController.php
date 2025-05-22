<?php
class HomeController
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /RentalMotor/auth/login");
            exit();
        }

        include __DIR__ . '/../views/dashboard.php';
    }
}
