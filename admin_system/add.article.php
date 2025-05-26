<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $date = date("Y-m-d");

    $conn = new mysqli("localhost", "root", "", "hendrik_legi_website");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO articles (title, content, author, publish_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $content, $author, $date);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    $success = "Artikel berhasil ditambahkan!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Artikel</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Tambah Artikel</h2>
  <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
  <form method="post">
    <label>Judul Artikel:<br><input type="text" name="title" required></label><br>
    <label>Penulis:<br><input type="text" name="author" required></label><br>
    <label>Isi Artikel:<br><textarea name="content" rows="10" required></textarea></label><br>
    <button type="submit">Simpan</button>
  </form>
  <p><a href="dashboard.php">← Kembali ke Dashboard</a></p>
</body>
</html>
