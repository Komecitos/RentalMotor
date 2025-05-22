<?php

// Cek apakah user sudah login, kalau belum redirect ke login
if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h1>Selamat datang, <?= htmlspecialchars($_SESSION['user']['username']) ?></h1>

    <p>Ini adalah halaman dashboard utama sistem rekomendasi rental motor.</p>

    <a href="index.php?page=logout">Logout</a>
</body>

</html>