<?php
require_once 'config.php';
session_start();
?>

<?php
session_start();

$mysqli = new mysqli("localhost", "root", "", "website_cms");

// Cek koneksi
if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Tambahkan admin default jika belum ada data
$result = $mysqli->query("SELECT COUNT(*) AS total FROM admin");
$data = $result->fetch_assoc();
if ($data['total'] == 0) {
    $default_user = 'Hendrik_admin';
    $default_pass = password_hash('hendrik_core@99', PASSWORD_DEFAULT);
    $mysqli->query("INSERT INTO admin (username, password) VALUES ('$default_user', '$default_pass')");
}

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $mysqli->prepare("SELECT id, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();
        if (password_verify($password, $hashed_password)) {
            $_SESSION["admin_id"] = $id;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login Admin</title>
    <link rel="stylesheet" href="admin-style.css" />
    <style>
        /* admin-style.css */

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', sans-serif;
}

body {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.container {
    background: #fff;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    text-align: left;
    font-weight: 600;
    margin: 10px 0 5px;
    color: #555;
}

input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    transition: border-color 0.3s;
}

input:focus {
    border-color: #007bff;
    outline: none;
}

button {
    margin-top: 20px;
    padding: 12px;
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s;
}

button:hover {
    background-color: #0056b3;
}

.error {
    color: red;
    background-color: #ffe5e5;
    border: 1px solid red;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 8px;
}

.info {
    margin-top: 20px;
    font-size: 0.9rem;
    color: #666;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Login Admin</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <form method="post">
            <label for="username">Username</label>
            <input id="username" type="text" name="username" placeholder="Username" required>

            <label for="password">Password</label>
            <input id="password" type="password" name="password" placeholder="Password" required>

            <button type="submit">Login</button>
        </form>
        <p class="info">Gunakan <strong>Username:</strong> admin, <strong>Password:</strong> admin123</p>
    </div>
</body>
</html>
