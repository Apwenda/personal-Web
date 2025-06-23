<?php
require_once 'config.php';
session_start();
?>

<?php
session_start();
unset($_SESSION['form_error']);

// Koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "website_cms";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_SESSION['buku'])) {
        $_SESSION['form_error'] = "Data buku tidak ditemukan. Silakan ulangi proses.";
        header("Location: tambah_buku.php");
        exit;
    }

    $buku = $_SESSION['buku'];

    // Ambil hanya nama file gambarnya, bukan path lengkap
    $gambar_name = basename($buku["gambar"]);

    // Escape input untuk keamanan
    $judul_esc     = $conn->real_escape_string($buku["judul"]);
    $deskripsi_esc = $conn->real_escape_string($buku["deskripsi"]);
    $link_esc      = $conn->real_escape_string($buku["link"]);
    $gambar_esc    = $conn->real_escape_string($gambar_name);

    // Simpan ke database
    $sql = "INSERT INTO buku (judul, deskripsi, link, gambar) VALUES ('$judul_esc', '$deskripsi_esc', '$link_esc', '$gambar_esc')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['success'] = "✅ Buku berhasil disimpan dan di upload ke website anda!";
        unset($_SESSION['buku']); // Hapus data setelah disimpan
    } else {
        $_SESSION['success'] = "❌ Gagal menyimpan data yang anda inputkan: " . $conn->error;
    }

    header("Location: konfirmasi_buku.php");
    exit;
}
?>
