<?php
require_once 'config.php';
session_start();
?>

<?php
session_start();
$error = $_SESSION['form_error'] ?? null;
unset($_SESSION['form_error']);

$old = $_SESSION['artikel_data'] ?? ['judul' => '', 'deskripsi' => '', 'link' => ''];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Tambah Artikel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
  body {
    background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
    font-family: 'Segoe UI', sans-serif;
    padding-top: 50px;
  }

  .form-container {
    max-width: 600px;
    margin: auto;
    background: #fff;
    padding: 40px 30px;
    border-radius: 16px;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    animation: fadeIn 0.5s ease-in-out;
  }

  .form-container h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
  }

  .form-label {
    font-weight: 600;
    color: #444;
  }

  .form-control {
    border-radius: 8px;
    font-size: 16px;
    padding: 10px;
  }

  .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    border-color: #007bff;
  }

  .btn-primary {
    padding: 12px;
    font-weight: 600;
    font-size: 16px;
    border-radius: 8px;
    transition: background-color 0.3s ease;
  }

  .btn-primary:hover {
    background-color: #0056b3;
  }

  .back-link {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #444;
    font-weight: 500;
    text-decoration: none;
  }

  .back-link:hover {
    text-decoration: underline;
  }

  .alert-danger {
    font-size: 0.95rem;
    padding: 12px;
    border-radius: 8px;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
  }
</style>

</head>
<body>
  <div class="form-container">
    <h2>➕ Tambah Artikel Baru</h2>

    <?php if ($error): ?>
      <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="konfirmasi_artikel.php" method="POST">
      <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" name="judul" id="judul" value="<?php echo htmlspecialchars($old['judul']); ?>" required>
      </div>

      <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4" required><?php echo htmlspecialchars($old['deskripsi']); ?></textarea>
      </div>

      <div class="mb-3">
        <label for="link" class="form-label">Link</label>
        <input type="url" class="form-control" name="link" id="link" value="<?php echo htmlspecialchars($old['link']); ?>" required>
      </div>

      <button type="submit" class="btn btn-primary w-100">Simpan</button>
      <a class="back-link" href="dashboard.php">⬅️ Kembali ke Halaman Utama</a>
    </form>
  </div>
</body>
</html>
