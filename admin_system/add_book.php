<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $description = $_POST['description'];

    $conn = new mysqli("localhost", "root", "", "hendrik_legi_website");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO books (title, author, year, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $title, $author, $year, $description);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    $success = "Buku berhasil ditambahkan!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Buku</title>
 <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Tambah Buku</h2>
  <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
  <form method="post">
    <label>Judul Buku:<br><input type="text" name="title" required></label><br>
    <label>Penulis:<br><input type="text" name="author" required></label><br>
    <label>Tahun Terbit:<br><input type="number" name="year" required></label><br>
    <label>Deskripsi:<br><textarea name="description" required></textarea></label><br>
    <button type="submit">Simpan</button>
  </form>
  <p><a href="dashboard.php">← Kembali ke Dashboard</a></p>
</body>
</html>
