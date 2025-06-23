<?php
require_once 'config.php';
session_start();
?>

<?php
session_start();

// Jika POST dari form tambah_artikel.php, validasi ulang
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['judul'])) {
    $judul = trim($_POST['judul'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $link = trim($_POST['link'] ?? '');

    if (!$judul || !$deskripsi || !$link) {
        $_SESSION['form_error'] = "Semua kolom wajib diisi.";
        $_SESSION['artikel_data'] = $_POST;
        header("Location: tambah_artikel.php");
        exit;
    }

    if (!filter_var($link, FILTER_VALIDATE_URL)) {
        $_SESSION['form_error'] = "Link tidak valid.";
        $_SESSION['artikel_data'] = $_POST;
        header("Location: tambah_artikel.php");
        exit;
    }

    $_SESSION['artikel_data'] = [
        'judul' => $judul,
        'deskripsi' => $deskripsi,
        'link' => $link,
    ];
}

// Ambil data artikel dari session jika tersedia
$data = $_SESSION['artikel_data'] ?? null;

// Ambil status hasil penyimpanan (jika baru kembali dari simpan_artikel.php)
$status = $_SESSION['status'] ?? null;
unset($_SESSION['status']); // Supaya tidak muncul terus-menerus

// Jika tidak ada data dan tidak ada status, maka redirect balik
if (!$data && !$status) {
    header("Location: tambah_artikel.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Konfirmasi Artikel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
  background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  padding: 40px 20px;
  min-height: 100vh;
}

.confirmation-container {
  max-width: 700px;
  margin: auto;
  animation: fadeIn 0.4s ease-in-out;
}

.card-custom {
  background-color: #fff;
  border-radius: 16px;
  padding: 40px 30px;
  box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
}

.card-custom h2 {
  font-weight: bold;
  color: #333;
  margin-bottom: 30px;
}

.status-success,
.status-fail {
  font-size: 4rem;
  margin-bottom: 10px;
}

.status-success {
  color: #28a745;
}

.status-fail {
  color: #dc3545;
}

.status-message {
  font-size: 1.2rem;
  font-weight: 600;
}

.info-label {
  font-weight: 600;
  color: #333;
  margin-top: 20px;
  margin-bottom: 5px;
}

p {
  font-size: 1rem;
  color: #444;
}

a {
  word-break: break-word;
}

.button-group {
  margin-top: 30px;
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  justify-content: center;
}

.btn {
  padding: 10px 20px;
  font-weight: 600;
  border-radius: 8px;
  transition: all 0.3s ease;
}

.btn-success:hover {
  background-color: #218838;
}

.btn-secondary:hover {
  background-color: #5a6268;
}

.btn-primary:hover {
  background-color: #004085;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 576px) {
  .status-message {
    font-size: 1rem;
  }

  .btn {
    width: 100%;
  }
}

  </style>
</head>
<body>
  <div class="container confirmation-container">
    <div class="card card-custom">

      <h2 class="mb-4 text-center">Konfirmasi Artikel</h2>

      <?php if ($status): ?>
        <div class="text-center my-4">
          <?php if ($status['success']): ?>
            <div class="status-success">&#10004;</div>
            <div class="status-message text-success"><?= htmlspecialchars($status['message']) ?></div>
          <?php else: ?>
            <div class="status-fail">&#10006;</div>
            <div class="status-message text-danger"><?= htmlspecialchars($status['message']) ?></div>
          <?php endif; ?>
        </div>

        <div class="button-group justify-content-center">
          <a href="tambah_artikel.php" class="btn btn-primary">Tambah Artikel Baru</a>
          <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div>

      <?php elseif ($data): ?>
        <p class="info-label">Judul:</p>
        <p><?= htmlspecialchars($data['judul']) ?></p>

        <p class="info-label">Deskripsi:</p>
        <p><?= nl2br(htmlspecialchars($data['deskripsi'])) ?></p>

        <p class="info-label">Link:</p>
        <p><a href="<?= htmlspecialchars($data['link']) ?>" target="_blank"><?= htmlspecialchars($data['link']) ?></a></p>

        <form method="post" action="simpan_artikel.php" class="button-group">
          <button type="submit" class="btn btn-success">Simpan Artikel</button>
          <a href="tambah_artikel.php" class="btn btn-secondary">Edit Kembali</a>
        </form>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
