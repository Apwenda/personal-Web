<?php
<<<<<<< HEAD
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi database
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "website_cms";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data artikel
$sql = "SELECT judul, deskripsi, link FROM artikel";
$result = $conn->query($sql);

if (!$result) {
  die("Query gagal: " . $conn->error);
}
?>

=======
// article.php

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "content_library");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data buku/artikel dari tabel books, urutkan terbaru dulu
$sql = "SELECT * FROM books ORDER BY id DESC";
$result = $conn->query($sql);
?>
>>>>>>> e7b93a3 (menambahkan beberapa file)
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Article_Hendrik Legi</title>
<<<<<<< HEAD
=======
  <!-- Bootstrap Icons -->
>>>>>>> e7b93a3 (menambahkan beberapa file)
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="css/styles.css" />
<<<<<<< HEAD
  <style>
    .custom-card {
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 15px;
  background-color: #fff;
  transition: box-shadow 0.3s ease-in-out;
}

.custom-card:hover {
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

/* Efek lembut terangkat + fade saat muncul */
.animate-card {
  opacity: 0;
  transform: translateY(20px);
  animation: fadeUp 0.6s ease-out forwards;
}

@keyframes fadeUp {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Efek mengangkat saat hover */
.custom-card {
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 15px;
  background-color: #fff;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.custom-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
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
        <li class="nav-item"><a class="nav-link" href="book.html">Books</a></li>
        <li class="nav-item"><a class="nav-link active" href="article.html">Articles</a></li>
        <li class="nav-item"><a class="nav-link" href="portofolio.html">Portfolio</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="container my-4">
  <section class="text-center fade-in">
    <h1 class="mb-3 fw-bold text-primary">Artikel Terbaru</h1>
    <p class="lead font">"Jelajahi refleksi iman dan kepemimpinan dalam dunia pendidikan."</p>
  </section>

  <!-- Article Section -->
  <section class="mt-4">
  <div class="row">
    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="col-12 col-md-6 col-lg-4 mb-4">
          <div class="custom-card h-100">
            <div class="card-body">
              <h5 class="card-title fw-bold"><?= htmlspecialchars($row['judul']) ?></h5>
              <p class="card-text mt-3"><?= nl2br(htmlspecialchars($row['deskripsi'])) ?></p>
              <a href="<?= htmlspecialchars($row['link']) ?>" target="_blank" class="btn btn-warning mt-2">Baca Artikel</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center text-danger">Belum ada artikel terbaru yang tersedia.</p>
    <?php endif; ?>
  </div>
</section>
</main>

<footer class="text-light pt-4 pb-3 mt-5">
  <div class="container">
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
          <li><a href="book.html" class="footer-link">Books</a></li>
          <li><a href="article.php" class="footer-link">Articles</a></li>
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
          <a href="https://www.facebook.com/share/16Lu4jcoqi/?mibextid=qi2Omg" target="_blank" class="text-light fs-5"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/hendrik_legi?igsh=MWF3MDhmbnk3amEwaA==" target="_blank" class="text-light fs-5"><i class="bi bi-instagram"></i></a>
          <a href="https://www.tiktok.com/@pace_tobelo85?_t=8qJjp2H9xtA&_r=1" target="_blank" class="text-light fs-5"><i class="bi bi-tiktok"></i></a>
          <a href="https://youtube.com/@hendriklegi85?si=SEL00ucmXjumeMcb" target="_blank" class="text-light fs-5"><i class="bi bi-youtube"></i></a>
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

=======
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container">
      <a class="navbar-brand" href="index.html">Hendrik Legi</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
          <li class="nav-item"><a class="nav-link" href="book.html">Books</a></li>
          <li class="nav-item"><a class="nav-link active" href="article.php">Articles</a></li>
          <li class="nav-item"><a class="nav-link" href="portofolio.html">Portfolio</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container my-4">
    <section class="text-center fade-in">
      <h1 class="mb-3 fw-bold text-primary">Kepemimpinan &amp; Spiritualitas Kristen</h1>
      <p class="lead font">
        "Jelajahi refleksi iman dan kepemimpinan dalam dunia pendidikan."
      </p>
    </section>

    <!-- Kontrol Navigasi Artikel -->
    <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
      <div>
        <div class="btn-group">
          <button type="button" class="btn btn-warning" onclick="window.location.href='new-article.html';">
            New Article
          </button>
        </div>
      </div>
    </div>

    <!-- Article Section -->
    <div class="row mt-4">
      <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <img
                src="uploads/<?php echo htmlspecialchars($row['image']); ?>"
                class="card-img-top"
                alt="Gambar Artikel"
                style="object-fit: cover; height: 200px;"
              />
              <div class="card-body d-flex flex-column">
                <p class="card-text mb-3"><?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                <a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank" class="btn btn-primary mt-auto"
                  >Baca Selengkapnya</a
                >
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p class="text-center">Belum ada artikel yang ditambahkan.</p>
      <?php endif; ?>
    </div>
  </main>

  <footer class="text-light pt-4 pb-3 mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-3">
          <h5 class="fw-bold">Hendrik Legi</h5>
          <p class="text-white small fw-bold mt-4">“Leadership Starts With Vision.”</p>
          <p>
            kepemimpinan yang efektif dimulai dari kemampuan seorang pemimpin untuk melihat ke depan, membayangkan masa depan yang lebih baik, dan menentukan arah yang jelas bagi tim atau organisasinya.
          </p>
        </div>

        <div class="col-md-4 mb-3">
          <h5 class="fw-bold">Navigasi</h5>
          <ul class="list-unstyled  mt-4">
            <li><a href="index.html" class="footer-link">Home</a></li>
            <li><a href="about.html" class="footer-link">About</a></li>
            <li><a href="book.html" class="footer-link">Books</a></li>
            <li><a href="article.php" class="footer-link">Articles</a></li>
            <li><a href="portofolio.html" class="footer-link">Portfolio</a></li>
            <li><a href="contact.html" class="footer-link">Contact</a></li>
          </ul>
        </div>

        <div class="col-md-4 mb-3">
          <h5 class="fw-bold">Follow Me</h5>
          <div class="my-4">
            <a href="socilal_link.html">
              <img src="assets/images/social link.png" class="social-image" alt="Gambar QR Media Social" />
            </a>
          </div>
          <div class="media-social d-inline-flex gap-3 mt-3">
            <a href="https://www.facebook.com/share/16Lu4jcoqi/?mibextid=qi2Omg" target="_blank" aria-label="Facebook" class="text-light fs-5"
              ><i class="bi bi-facebook"></i
            ></a>
            <a href="https://www.instagram.com/hendrik_legi?igsh=MWF3MDhmbnk3amEwaA==" target="_blank" aria-label="Instagram" class="text-light fs-5"
              ><i class="bi bi-instagram"></i
            ></a>
            <a href="https://www.tiktok.com/@pace_tobelo85?_t=8qJjp2H9xtA&_r=1" target="_blank" aria-label="Tiktok" class="text-light fs-5"
              ><i class="bi bi-tiktok"></i
            ></a>
            <a href="https://youtube.com/@hendriklegi85?si=SEL00ucmXjumeMcb" target="_blank" aria-label="youtube" class="text-light fs-5"
              ><i class="bi bi-youtube"></i
            ></a>
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
>>>>>>> e7b93a3 (menambahkan beberapa file)
<?php $conn->close(); ?>
