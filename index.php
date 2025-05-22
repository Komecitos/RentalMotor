<?php
session_start();

require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/controllers/AuthController.php';

$db = (new Database())->connect();
$auth = new AuthController($db);

// Routing sederhana
$page = $_GET['page'] ?? 'login';

switch ($page) {
    case 'login':
        $auth->login();
        break;
    case 'logout':
        $auth->logout();
        break;
    case 'dashboard':
        include __DIR__ . '/views/dashboard.php';
        break;
    default:
        echo "404 Not Found";
        break;
}
