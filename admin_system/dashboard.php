<?php
require_once 'config.php';
session_start();
?>

<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Admin</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .admin-profile {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px;
}

.profile-pic {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    margin-bottom: 10px;
}

.admin-name {
    margin: 0;
    font-weight: 700;
    color: #333;
}

.admin-role {
    margin: 0;
    font-size: 0.9rem;
    color: #555;
}

        body {
    background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 20px;
}

.card {
    padding: 40px 50px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.15);
    max-width: 400px;
    width: 100%;
    background-color: #ffffffdd;
    backdrop-filter: saturate(180%) blur(10px);
    transition: transform 0.3s ease;
}

.card:hover {
    transform: translateY(-8px);
}

.card h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #222;
    font-weight: 700;
    letter-spacing: 1.2px;
}

.d-grid.gap-3 > a.btn {
    padding: 12px 0;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 12px;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #3a9bdc;
    box-shadow: 0 4px 12px rgba(58,155,220,0.5);
}

.btn-success:hover {
    background-color: #34a853;
    box-shadow: 0 4px 12px rgba(52,168,83,0.5);
}

.logout-link {
    display: block;
    text-align: center;
    margin-top: 25px;
    color: #dc3545;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    transition: color 0.3s ease;
}

.logout-link:hover {
    color: #a71d2a;
    text-decoration: underline;
}
    </style>
</head>
<body>
    <div class="card text-center">
        <div class="admin-profile mb-4">
            <img src="img/Profile.HL.jpg" alt="Foto Admin" class="profile-pic">
            <h4 class="admin-name">Hendrik Legi</h4>
            <p class="admin-role">Admin Website Buku & Artikel</p>
        </div>
        <div class="d-grid gap-3">
            <a href="tambah_artikel.php" class="btn btn-primary">Tambah Artikel</a>
            <a href="tambah_buku.php" class="btn btn-success">Tambah Buku</a>
        </div>
        <a href="logout.php" class="logout-link">Logout</a>
    </div>

    <!-- Bootstrap JS (opsional jika tidak ada modal/dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
