<?php
require_once 'config.php';
session_start();
?>

<?php
session_start();

// Ambil data dari session
$data = $_SESSION['artikel_data'] ?? null;

if (!$data) {
    $_SESSION['status'] = [
        'success' => false,
        'message' => 'Data artikel tidak ditemukan.',
    ];
    header("Location: konfirmasi_artikel.php");
    exit;
}

// Koneksi langsung ke database
$host = "localhost";
$user = "root";
$password = ""; // Ganti jika ada password
$dbname = "website_cms";

$koneksi = new mysqli($host, $user, $password, $dbname);

if ($koneksi->connect_error) {
    $_SESSION['status'] = [
        'success' => false,
        'message' => 'Koneksi database gagal: ' . $koneksi->connect_error,
    ];
    header("Location: konfirmasi_artikel.php");
    exit;
}

// Simpan data ke database
$judul = $koneksi->real_escape_string($data['judul']);
$deskripsi = $koneksi->real_escape_string($data['deskripsi']);
$link = $koneksi->real_escape_string($data['link']);

$query = "INSERT INTO artikel (judul, deskripsi, link) VALUES ('$judul', '$deskripsi', '$link')";

if ($koneksi->query($query)) {
    $_SESSION['status'] = [
        'success' => true,
        'message' => 'Artikel berhasil disimpan!',
    ];
    unset($_SESSION['artikel_data']); // Hapus data setelah berhasil simpan
} else {
    $_SESSION['status'] = [
        'success' => false,
        'message' => 'Gagal menyimpan artikel: ' . $koneksi->error,
    ];
}

$koneksi->close();
header("Location: konfirmasi_artikel.php");
exit;
