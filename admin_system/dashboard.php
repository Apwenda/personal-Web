<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Selamat datang, Admin!</h2>
  <nav>
    <a href="add_book.php">Tambah Buku</a>
    <a href="add_article.php">Tambah Artikel</a>
    <a href="add_portfolio.php">Tambah Penghargaan</a>
    <a href="logout.php">Logout</a>
  </nav>
</body>
</html>
