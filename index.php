<?php
include "koneksi.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Index | My Mountain Journal</title>
  <link rel="icon" href="https://cdn-icons-png.flaticon.com/128/2072/2072317.png" type="image/x-icon">
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous" />
</head>

<body>
  <!-- nav begin -->
  <nav class="navbar navbar-expand-sm bg-body-tertiary sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">My Mountain Journal</a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#article">Article</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#gallery">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#schedule">Schedule</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#aboutme">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
        </ul>
        <div class="d-flex align-items-center mt-2 mt-sm-0">
          <button
            type="button"
            class="btn btn-dark theme"
            id="dark"
            title="dark">
            <i class="bi bi-moon-stars-fill"></i>
          </button>
          <button
            type="button"
            class="btn btn-danger theme ms-2"
            id="light"
            title="light">
            <i class="bi bi-brightness-high"></i>
          </button>
        </div>
      </div>
    </div>
  </nav>
  <!-- nav end -->
  <!-- hero begin -->
  <section id="hero" class="text-center p-5 bg-danger-subtle text-sm-start">
    <div class="container">
      <div class="d-sm-flex flex-sm-row-reverse align-items-center">
        <img src="https://cdn.pixabay.com/photo/2017/05/09/10/59/mount-fuji-2297961_640.jpg" class="img-fluid" width="800" />
        <div>
          <h1 class="fw-bold display-4">
            Explore the Beauty of Mountains
          </h1>
          <h4 class="lead display-6">
            Discover the breathtaking views and serene landscapes of mountain ranges
          </h4>
          <h6>
            <span id="tanggal"></span>
            <span id="jam"></span>
          </h6>
        </div>
      </div>
    </div>
  </section>
  <!-- hero end -->
  <!-- article begin -->
  <section id="article" class="text-center p-5">
    <div class="container">
      <h1 class="fw-bold display-4 pb-3 pt-5">Article</h1>
      <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
        <?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql);

        while ($row = $hasil->fetch_assoc()) {
        ?>
          <div class="col">
            <div class="card h-100">
              <img src="img/<?= $row["gambar"] ?>" class="card-img-top" alt="..." />
              <div class="card-body">
                <h5 class="card-title"><?= $row["judul"] ?></h5>
                <p class="card-text">
                  <?= $row["isi"] ?>
                </p>
              </div>
              <div class="card-footer">
                <small class="text-body-secondary">
                  <?= $row["tanggal"] ?>
                </small>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </section>
  <!-- article end -->
  <!-- gallery begin -->
  <section id="gallery" class="text-center p-5 bg-danger-subtle">
    <div class="container">
      <h1 class="fw-bold display-4 pb-3 pt-5">Gallery</h1>
      <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <?php
          // Query untuk mengambil data dari tabel gallery
          $sql2 = "SELECT * FROM gallery ORDER BY tanggal DESC";
          $hasil2 = $conn->query($sql2);

          $active_class = "active"; // Kelas active untuk item pertama

          if ($hasil2->num_rows > 0) {
            while ($row = $hasil2->fetch_assoc()) {
              $image_file = $row['gambar']; // Mengambil nama file dari kolom gambar
              $image_url = "img/" . $image_file; // Gabungkan dengan path folder img
              echo '
                        <div class="carousel-item ' . $active_class . '">
                            <img src="' . $image_url . '" class="d-block w-100" alt="Gallery Image" />
                        </div>';
              $active_class = ""; // Hapus kelas active untuk item berikutnya
            }
          } else {
            echo '<div class="carousel-item active">
                            <p>No images available in the gallery.</p>
                        </div>';
          }
          ?>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExample"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExample"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
  </section>
  <!-- gallery end -->
  <!-- schedule begin -->
  <section id="schedule" class="text-center p-5">
    <div class="container">
      <h1 class="fw-bold display-4 pb-3 pt-5">Schedule</h1>
      <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-danger text-white">SENIN</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Basis Data Teori<br />08.40 - 10.20 | H.5.7
              </li>
              <li class="list-group-item">
                Sistem Operasi<br />12.30 - 15.00 | H.4.9
              </li>
            </ul>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-danger text-white">SELASA</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Pendidikan Kewarganegaraan<br />08.40 - 10.20 | Aula H7
              </li>
              <li class="list-group-item">
                Probabilitas dan Statistik<br />12.30 - 15.00 | H.4.9
              </li>
            </ul>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-danger text-white">RABU</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Basis Data Praktek<br />08.40 - 10.20 | D.3.M
              </li>
              <li class="list-group-item">
                Kriptografi<br />12.30 - 15.00 | H.4.11
              </li>
            </ul>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-danger text-white">KAMIS</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Pemrograman Web<br />08.40 - 10.20 | D.2.J
              </li>
              <li class="list-group-item">
                Logika Informatika<br />12.30 - 15.00 | H.4.5
              </li>
            </ul>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-danger text-white">JUMAT</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">
                Rekayasa Perangkat Lunak<br />09.30 - 12.00 | H.4.5
              </li>
            </ul>
          </div>
        </div>
        <div class="col">
          <div class="card h-100">
            <div class="card-header bg-danger text-white">SABTU</div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">FREE</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- schedule end -->
  <!-- about me begin -->
  <section id="aboutme" class="text-center p-5 bg-danger-subtle">
    <div class="container">
      <h1 class="fw-bold display-4 pb-3 pt-5">About Me</h1>
      <div class="d-sm-flex align-items-center justify-content-center">
        <div class="d-flex justify-content-center p-3">
          <img
            src="img/20240411_095837.jpg"
            class="rounded-circle border shadow"
            width="300" height="300" />
        </div>
        <div class="p-md-5 text-sm-start">
          <h3 class="lead">A11.2023.14914</h3>
          <h1 class="fw-bold">Muhammad Raihan Naufal</h1>
          Program Studi Teknik Informatika<br />
          <a href="https://dinus.ac.id/" class="fw-bold text-decoration-none text-black">Universitas Dian Nuswantoro</a>
        </div>
      </div>
    </div>
  </section>
  <!-- about me end -->
  <!-- footer begin -->
  <footer id="footer" class="text-center p-5">
    <div>
      <a href="https://www.instagram.com/udinusofficial"><i class="bi bi-instagram h2 p-2"></i></a>
      <a href="https://twitter.com/udinusofficial"><i class="bi bi-twitter h2 p-2"></i></a>
      <a href="https://wa.me/+628562669588"><i class="bi bi-whatsapp h2 p-2"></i></a>
    </div>
    <div>Muhammad Raihan Naufal &copy; 2024</div>
  </footer>
  <!-- footer end -->

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script type="text/javascript">
    window.setTimeout("tampilWaktu()", 1000);

    function tampilWaktu() {
      var waktu = new Date();
      var bulan = waktu.getMonth() + 1;
      var tanggal = waktu.getDate();
      var tahun = waktu.getFullYear();
      var jam = waktu.getHours().toString().padStart(2, '0');
      var menit = waktu.getMinutes().toString().padStart(2, '0');
      var detik = waktu.getSeconds().toString().padStart(2, '0');

      setTimeout(tampilWaktu, 1000);
      document.getElementById("tanggal").innerHTML = `${tanggal}/${bulan}/${tahun}`;
      document.getElementById("jam").innerHTML = `${jam}:${menit}:${detik}`;
    }
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script type="text/javascript">
    document.getElementById("dark").onclick = function() {
      document.body.style.backgroundColor = "black";

      document
        .getElementById("hero")
        .classList.remove("bg-danger-subtle", "text-black");
      document
        .getElementById("hero")
        .classList.add("bg-secondary", "text-white");

      document
        .getElementById("gallery")
        .classList.remove("bg-danger-subtle", "text-black");
      document
        .getElementById("gallery")
        .classList.add("bg-secondary", "text-white");

      document
        .getElementById("aboutme")
        .classList.remove("bg-danger-subtle", "text-black");
      document
        .getElementById("aboutme")
        .classList.add("bg-secondary", "text-white");

      document.getElementById("footer").classList.remove("text-black");
      document.getElementById("footer").classList.add("text-white");

      document.getElementById("article").classList.remove("text-black");
      document.getElementById("article").classList.add("text-white");

      document.getElementById("schedule").classList.remove("text-black");
      document.getElementById("schedule").classList.add("text-white");

      const collection = document.getElementsByClassName("card");
      for (let i = 0; i < collection.length; i++) {
        collection[i].classList.add("bg-secondary", "text-white");
      }

      const collection2 = document.getElementsByClassName("list-group-item");
      for (let i = 0; i < collection2.length; i++) {
        collection2[i].classList.add("bg-secondary", "text-white");
      }
    };

    document.getElementById("light").onclick = function() {
      document.body.style.backgroundColor = "white";

      document
        .getElementById("hero")
        .classList.remove("bg-secondary", "text-white");
      document
        .getElementById("hero")
        .classList.add("bg-danger-subtle", "text-black");

      document
        .getElementById("gallery")
        .classList.remove("bg-secondary", "text-white");
      document
        .getElementById("gallery")
        .classList.add("bg-danger-subtle", "text-black");

      document
        .getElementById("aboutme")
        .classList.remove("bg-secondary", "text-white");
      document
        .getElementById("aboutme")
        .classList.add("bg-danger-subtle", "text-black");

      document.getElementById("footer").classList.remove("text-white");
      document.getElementById("footer").classList.add("text-black");

      document.getElementById("article").classList.remove("text-white");
      document.getElementById("article").classList.add("text-black");

      document.getElementById("schedule").classList.remove("text-white");
      document.getElementById("schedule").classList.add("text-black");

      const collection = document.getElementsByClassName("card");
      for (let i = 0; i < collection.length; i++) {
        collection[i].classList.remove("bg-secondary", "text-white");
      }

      const collection2 = document.getElementsByClassName("list-group-item");
      for (let i = 0; i < collection2.length; i++) {
        collection2[i].classList.remove("bg-secondary", "text-white");
      }
    };
  </script>
</body>
</html>
