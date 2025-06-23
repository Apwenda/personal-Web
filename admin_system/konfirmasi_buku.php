<?php
require_once 'config.php';
session_start();
?>

<?php
session_start();

// Ambil data buku dari session
$buku = $_SESSION['buku'] ?? null;
$success = $_SESSION['success'] ?? null;

// Tampilkan pesan error jika data buku tidak ditemukan DAN tidak ada notifikasi sukses
if (!$buku && !$success) {
    echo "<p style='color:red;'>Data buku tidak ditemukan. Silakan ulangi proses.</p>";
    exit;
}

// Validasi URL (jika data buku masih ada)
if ($buku && !filter_var($buku['link'], FILTER_VALIDATE_URL)) {
    echo "<p style='color:red;'>Link buku tidak valid.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Buku</title>
    <link rel="stylesheet" href="admin-style.css" />
    <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f6f8fa;
    margin: 0;
    padding: 0;
    color: #333;
}

.container {
    max-width: 720px;
    margin: 40px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
}

h2 {
    margin-top: 0;
    font-size: 24px;
    color: #222;
    text-align: center;
}

.preview {
    text-align: center;
    margin-bottom: 20px;
}

.preview img {
    max-width: 250px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.success {
    background-color: #e6f9ed;
    color: #2d7a4b;
    border: 1px solid #b6e5c4;
    padding: 12px 18px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: bold;
    text-align: center;
}

.error {
    background-color: #fcebea;
    color: #cc1f1a;
    border: 1px solid #f5c6cb;
    padding: 12px 18px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: bold;
    text-align: center;
}

p {
    margin-bottom: 12px;
    line-height: 1.5;
}

a.back-link {
    display: inline-block;
    margin: 10px 10px 0 0;
    color: #1d72b8;
    text-decoration: none;
    font-weight: 500;
}

a.back-link:hover {
    text-decoration: underline;
}

form button {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 10px 20px;
    margin-top: 10px;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s;
}

form button:hover {
    background-color: #218838;
}

form button[type="button"] {
    background-color: #6c757d;
}

form button[type="button"]:hover {
    background-color: #5a6268;
}

    </style>
    <script>
    // Redirect ke dashboard setelah 3 detik
    setTimeout(function() {
        window.location.href = "konfirmasi_buku.php";
    }, 20000);
</script>

</head>
<body>
<div class="container">
    <h2>📘 Konfirmasi Data Buku</h2>

    <?php if ($success): ?>
        <p class="success" style="color:green;"><?php echo htmlspecialchars($success); ?></p>
        <?php
        unset($_SESSION['success']);
        unset($_SESSION['buku']);
        ?>
        <a href="tambah_buku.php" class="back-link">➕ Tambah Buku Baru</a>
        <a href="dashboard.php" class="back-link">⬅️ Kembali ke Dashboard</a>
    <?php elseif ($buku): ?>
        <div class="preview">
            <img src="uploads/<?php echo htmlspecialchars($buku['gambar']); ?>" alt="Cover Buku" style="max-width: 100%; border-radius: 10px;" />
        </div>

        <p><strong>Judul:</strong> <?php echo htmlspecialchars($buku['judul']); ?></p>
        <p><strong>Deskripsi:</strong><br><?php echo nl2br(htmlspecialchars($buku['deskripsi'])); ?></p>
        <p><strong>Link:</strong> <a href="<?php echo htmlspecialchars($buku['link']); ?>" target="_blank"><?php echo htmlspecialchars($buku['link']); ?></a></p>

        <form action="simpan_buku.php" method="post" style="margin-top: 2rem;">
            <button type="submit">✅ Konfirmasi & Simpan</button>
            <button type="button" onclick="window.history.back();" style="margin-left: 1rem;">🔙 Kembali</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
