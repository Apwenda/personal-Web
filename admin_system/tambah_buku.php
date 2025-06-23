<?php
require_once 'config.php';
session_start();
?>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $judul = $_POST["judul"] ?? '';
    $deskripsi = $_POST["deskripsi"] ?? '';
    $link = $_POST["link"] ?? '';

    $upload_dir = "uploads/";
    $gambar_name = basename($_FILES["gambar"]["name"]);
    $gambar_tmp = $_FILES["gambar"]["tmp_name"];
    $gambar_path = $upload_dir . $gambar_name;

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (empty($judul) || empty($deskripsi) || empty($link) || empty($gambar_name)) {
        $_SESSION['form_error'] = "Semua kolom wajib diisi.";
        header("Location: tambah_buku.php");
        exit;
    }

    if (!filter_var($link, FILTER_VALIDATE_URL)) {
        $_SESSION['form_error'] = "Link tidak valid.";
        header("Location: tambah_buku.php");
        exit;
    }

    if (move_uploaded_file($gambar_tmp, $gambar_path)) {
        $_SESSION['buku'] = [
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'link' => $link,
            'gambar' => $gambar_name
        ];
        header("Location: konfirmasi_buku.php");
        exit;
    } else {
        $_SESSION['form_error'] = "Gagal mengunggah gambar.";
        header("Location: tambah_buku.php");
        exit;
    }
}

$error = $_SESSION['form_error'] ?? null;
unset($_SESSION['form_error']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <link rel="stylesheet" href="admin-style.css" />
    <style>
        /* Reset & dasar */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f6f8fa;
    margin: 0;
    padding: 0;
    color: #333;
}

.container {
    max-width: 600px;
    margin: 40px auto;
    background-color: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 0 20px rgba(0,0,0,0.05);
}

h2 {
    margin-top: 0;
    font-size: 26px;
    color: #222;
    text-align: center;
    margin-bottom: 25px;
}

/* Pesan error */
.error {
    background-color: #fcebea;
    color: #cc1f1a;
    border: 1px solid #f5c6cb;
    padding: 12px 18px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 600;
    text-align: center;
}

/* Form styling */
form label {
    display: block;
    font-weight: 600;
    margin-bottom: 6px;
    margin-top: 15px;
    color: #444;
}

form input[type="text"],
form input[type="url"],
form input[type="file"],
form textarea {
    width: 100%;
    padding: 10px 14px;
    border: 1.8px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s;
    box-sizing: border-box;
}

form input[type="text"]:focus,
form input[type="url"]:focus,
form input[type="file"]:focus,
form textarea:focus {
    outline: none;
    border-color: #1d72b8;
    box-shadow: 0 0 6px rgba(29, 114, 184, 0.3);
}

/* Textarea spesifik */
form textarea {
    resize: vertical;
}

/* Tombol submit */
form button[type="submit"] {
    background-color: #1d72b8;
    color: #fff;
    border: none;
    padding: 12px 22px;
    font-size: 18px;
    border-radius: 10px;
    cursor: pointer;
    margin-top: 25px;
    width: 100%;
    font-weight: 600;
    transition: background-color 0.3s;
}

form button[type="submit"]:hover {
    background-color: #155d8b;
}

/* Link kembali */
a.back-link {
    display: inline-block;
    margin-top: 25px;
    color: #1d72b8;
    text-decoration: none;
    font-weight: 500;
    text-align: center;
    width: 100%;
}

a.back-link:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
<div class="container">
    <h2>➕ Tambah Buku Baru</h2>

    <?php if ($error): ?>
        <p class="error" style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="tambah_buku.php" method="POST" enctype="multipart/form-data">
        <label for="gambar">Unggah Gambar:</label>
        <input type="file" name="gambar" id="gambar" accept="image/*" required>

        <label for="judul">Judul Buku:</label>
        <input type="text" name="judul" id="judul" required>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi" rows="4" required></textarea>

        <label for="link">Link Buku (URL):</label>
        <input type="url" name="link" id="link" required>

        <button type="submit">Lanjut ke Konfirmasi</button>
    </form>

    <a class="back-link" href="dashboard.php">⬅️ Kembali ke Halaman Utama</a>
</div>
</body>
</html>
