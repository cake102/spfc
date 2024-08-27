<?php
session_start();

// koneksi database
include "config.php";

// Cek jika pengguna sudah login
if (!isset($_SESSION['role'])) {
    // Jika pengguna belum login, izinkan mereka mengakses halaman
    $_SESSION['role'] = 'Guest'; // Set default role sebagai 'Guest' atau pengguna biasa
}

// Cek role pengguna
if ($_SESSION['role'] == "Admin" && $_SESSION['status'] != "y") {
    // Jika pengguna adalah admin dan belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Pastikan untuk menghentikan eksekusi lebih lanjut setelah redirect
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPFC</title>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href="asset/css/bootstrap.min.css">
    <!-- datatables css -->
    <link rel='stylesheet' href="asset/css/datatables.min.css">
    <!-- Font Awesome -->
    <link rel='stylesheet' href="asset/css/all.css">
    <!-- Choosen css -->
    <link rel='stylesheet' href="asset/css/bootstrap-choosen.css">

    <style>
        .welcome-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 100vh;
        }
        .welcome-text {
            font-size: 36px;
            font-weight: bold;
        }
        .welcome-image {
            max-width: 500%;
            height: 80vh;
        }
    </style>
</head>
<body>
    
<!-- navbar -->
<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Home</a>
    </li>
    <!-- setting akses -->
    <?php
      if($_SESSION['role'] == "Dokter"){
    ?> 
      <li class="nav-item active">
        <a class="nav-link" href="?page=users">Users</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?page=aturan">Basis Aturan</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?page=konsultasiadm">Konsultasi</a>
      </li>
    <?php
      } elseif($_SESSION['role'] == "Admin"){
    ?> 
      <li class="nav-item active">
        <a class="nav-link" href="?page=gejala">Gejala</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?page=penyakit">Penyakit</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?page=aturan">Basis Aturan</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="?page=konsultasi">Konsultasi</a>
      </li>
    <?php
      } else { // Jika pengguna adalah Guest (belum login)
    ?>  
      <li class="nav-item active">
        <a class="nav-link" href="?page=konsultasi">Konsultasi</a>
      </li>
      <!-- Tombol Login untuk Guest -->
      <li class="nav-item active">
        <a class="nav-link" href="login.php">Login</a>
      </li>
    <?php
      }

      // Tombol Logout hanya untuk Admin dan Dokter
      if($_SESSION['role'] == "Admin" || $_SESSION['role'] == "Dokter") {
    ?>
      <li class="nav-item active">
        <a class="nav-link" href="?page=logout">Logout</a>
      </li>
    <?php
      }
    ?>
  </ul>
</nav>

<!-- container -->
<div class="container mt-5 mb-5">
    <?php
    // Mengecek apakah halaman yang sedang diakses adalah halaman utama
    $page = isset($_GET['page']) ? $_GET['page'] : "";

    if ($page == "") { 
    ?>
        <!-- Welcome Section Hanya di Halaman Utama -->
        <div class="row align-items-center justify-content-between welcome-section">
            <div class="col-md-6">
                <div class="welcome-text">
                    <?php include 'welcome.php'; ?>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <div class="welcome-image">
                    <img src="anxiety.jpg" alt="Gambar Selamat Datang" class="img-fluid">
                </div>
            </div>
        </div>
    <?php
    }
    ?>

    <!-- setting menu -->
    <?php
    $action = isset($_GET['action']) ? $_GET['action'] : "";

    if ($page == ""){
    } elseif ($page == "gejala"){
        if ($action == ""){
            include "tampil_gejala.php";
        } elseif ($action == "tambah"){
            include "tambah_gejala.php";
        } elseif ($action == "update"){
            include "update_gejala.php";
        } else {
            include "hapus_gejala.php";
        }
    } elseif ($page == "penyakit"){
        if ($action == ""){
            include "tampil_penyakit.php";
        } elseif ($action == "tambah"){
            include "tambah_penyakit.php";
        } elseif ($action == "update"){
            include "update_penyakit.php";
        } else {
            include "hapus_penyakit.php";
        }
    } elseif ($page == "aturan"){
        if ($action == ""){
            include "tampil_aturan.php";
        } elseif ($action == "tambah"){
            include "tambah_aturan.php";
        } elseif ($action == "detail"){
            include "detail_aturan.php";
        } elseif ($action == "update"){
            include "update_aturan.php";
        } elseif ($action == "hapus_gejala"){
            include "hapus_detail_aturan.php";
        } else {
            include "hapus_aturan.php";
        }
    } elseif ($page == "konsultasi"){
        if ($action == ""){
            include "tampil_konsultasi.php"; 
        } else {
            include "hasil_konsultasi.php";
        }
    } elseif ($page == "users"){
        if ($action == ""){
            include "tampil_users.php";
        } elseif ($action == "tambah"){
            include "tambah_users.php";
        } elseif ($action == "update"){
            include "update_users.php";
        } else {
            include "hapus_users.php";
        }
    } else {
        include "logout.php";
    }
    ?>
</div>

<!-- jquery -->
<script src="asset/js/jquery-3.7.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="asset/js/bootstrap.min.js"></script>
<!-- datatables js -->
<script src="asset/js/datatables.min.js"></script>
<script>
      $(document).ready(function() {
            $('#myTable').DataTable();
      });
</script>

<!-- Font Awesome -->
<script src="asset/js/all.js"></script> 

<!-- Choosen js -->
<script src="asset/js/choosen.jquery.min.js"></script>
<script>
      $(function() {
        $('.chosen').chosen();
      });
</script>

</body>
</html>
