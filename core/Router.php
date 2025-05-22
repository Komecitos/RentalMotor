<?php

session_start();
require_once './core/Database.php';
require_once './RentalMotor/controllers/AuthController.php';

$db = (new Database())->connect();

$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

switch ($controller) {
    case 'auth':
        $auth = new AuthController($db);
        if ($action == 'login') {
            $auth->login();
        } elseif ($action == 'register') {
            $auth->register();
        }
        break;
    default:
        echo "404 Not Found";
}
