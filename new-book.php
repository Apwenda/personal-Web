<?php
// new_book.php

// Konfigurasi koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "website_cms";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// Ambil data buku
$sql = "SELECT * FROM buku ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>New_Book_Hendrik Legi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="css/styles.css" />
  <style>
  .book-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 5px; /* Jarak antar card */
    justify-content: center;
  }

  .book-card {
    flex: 1 1 calc(33.333% - 20px); /* Tiga kolom */
    max-width: calc(33.333% - 20px);
    box-sizing: border-box;
  }

  @media (max-width: 768px) {
    .book-card {
      flex: 1 1 calc(50% - 20px); /* Dua kolom di tablet */
      max-width: calc(50% - 20px);
    }
  }

  @media (max-width: 576px) {
    .book-card {
      flex: 1 1 100%; /* Satu kolom di mobile */
      max-width: 100%;
    }
  }
</style>

</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">Hendrik Legi</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
          <li class="nav-item"><a class="nav-link active" href="book.html">Books</a></li>
          <li class="nav-item"><a class="nav-link" href="article.html">Articles</a></li>
          <li class="nav-item"><a class="nav-link" href="portofolio.html">Portfolio</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- section book -->
   <main class="container my-4">
    <section class="text-center fade-in">
      <h1 class="mb-3 fw-bold text-primary">Buku Terbaru</h1>
      <p class="lead font">"Jelajahi refleksi iman dan kepemimpinan dalam dunia pendidikan."</p>
    </section>
    <div class="book-grid">
  <?php if ($result && $result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
      <div class="book-card mt-3">
        <div class="card h-100 shadow-sm">
          <img
            src="<?php echo 'admin_system/uploads/' . htmlspecialchars($row['gambar']); ?>"
            class="card-img-top"
            alt="<?php echo htmlspecialchars($row['judul']); ?>"
            style="object-fit: cover; height: 200px;"
          />
          <div class="card-body d-flex flex-column">
            <h5 class="card-title text-black"><?php echo htmlspecialchars($row['judul']); ?></h5>
            <p class="card-text flex-grow-1"><?php echo nl2br(htmlspecialchars($row['deskripsi'])); ?></p>
            <a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank" class="btn btn-warning mt-auto">Telusuri Selengkapnya</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p class="text-center text-danger">Belum ada buku terbaru yang tersedia.</p>
  <?php endif; ?>
</div>
  </main>

  <footer class="text-light pt-4 pb-3 mt-5">
    <div class="container">
      <!-- Footer content tetap sama -->
      <div class="row">
        <div class="col-md-4 mb-3">
          <h5 class="fw-bold">Hendrik Legi</h5>
          <p class="text-white small fw-bold mt-4">“Leadership Starts With Vision.”</p>
          <p>kepemimpinan yang efektif dimulai dari kemampuan seorang pemimpin untuk melihat ke depan, membayangkan masa depan yang lebih baik, dan menentukan arah yang jelas bagi tim atau organisasinya.</p>
        </div>
        <div class="col-md-4 mb-3">
          <h5 class="fw-bold">Navigasi</h5>
          <ul class="list-unstyled mt-4">
            <li><a href="index.html" class="footer-link">Home</a></li>
            <li><a href="about.html" class="footer-link">About</a></li>
            <li><a href="new-book.php" class="footer-link">Books</a></li>
            <li><a href="article.html" class="footer-link">Articles</a></li>
            <li><a href="portofolio.html" class="footer-link">Portfolio</a></li>
            <li><a href="contact.html" class="footer-link">Contact</a></li>
          </ul>
        </div>
        <div class="col-md-4 mb-3">
          <h5 class="fw-bold">Follow Me</h5>
          <div class="my-4">
            <a href="socilal_link.html"><img src="assets/images/social link.png" class="social-image" alt="Gambar QR Media Social" /></a>
          </div>
          <div class="media-social d-inline-flex gap-3 mt-3">
            <a href="https://www.facebook.com/..." class="text-light fs-5"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/..." class="text-light fs-5"><i class="bi bi-instagram"></i></a>
            <a href="https://www.tiktok.com/..." class="text-light fs-5"><i class="bi bi-tiktok"></i></a>
            <a href="https://youtube.com/..." class="text-light fs-5"><i class="bi bi-youtube"></i></a>
          </div>
        </div>
      </div>

      <hr class="border-light mt-4" />
      <div class="container">&copy; 2025 HendrikLegi.com. developed by Deni Wenda.</div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
