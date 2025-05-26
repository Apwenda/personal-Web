<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $institution = $_POST['institution'];
    $year = $_POST['year'];
    $description = $_POST['description'];

    $conn = new mysqli("localhost", "root", "", "website_db");
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO awards (title, institution, year, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $title, $institution, $year, $description);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    $success = "Penghargaan berhasil ditambahkan!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Penghargaan</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Tambah Penghargaan</h2>
  <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
  <form method="post">
    <label>Nama Penghargaan:<br><input type="text" name="title" required></label><br>
    <label>Institusi:<br><input type="text" name="institution" required></label><br>
    <label>Tahun:<br><input type="number" name="year" required></label><br>
    <label>Deskripsi:<br><textarea name="description" rows="5" required></textarea></label><br>
    <button type="submit">Simpan</button>
  </form>
  <p><a href="dashboard.php">← Kembali ke Dashboard</a></p>
</body>
</html>
