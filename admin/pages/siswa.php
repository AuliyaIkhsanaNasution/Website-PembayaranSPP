<?php
require "functions/koneksi.php";
session_start();

// Redirect if not logged in
if (!isset($_SESSION["login"])) {
  header("Location: ../login.php");
  exit;
}

// Query untuk mengambil data siswa beserta nama_kelas
$query = "SELECT siswa.nisn, siswa.nis, siswa.nama, siswa.alamat, siswa.no_telepon, kelas.nama_kelas 
          FROM siswa 
          JOIN kelas ON siswa.id_kelas = kelas.id_kelas";
$hasil = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/logo.jpeg">
  <title>
    Siswa Admin Pembayaran SPP Smart School
  </title>
  <!-- icons google -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

      <!-- sweetalert -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">

<!-- alert -->
<?php
  if (isset($_GET['tambah'])) : ?>
    <script>
      Swal.fire({
        icon: "success",
        title: "Sukses",
        text: "Data Kelas berhasil Ditambahkan",
      });
    </script>
  <?php endif; ?>

  <?php
  if (isset($_GET['gagalnisn'])) : ?>
    <script>
      Swal.fire({
        icon: "error",
        title: "Gagal",
        text: "Data Siswa gagal Ditambahkan",
      });
    </script>
  <?php endif; ?>

  <?php
  if (isset($_GET['ubah'])) : ?>
    <script>
      Swal.fire({
        icon: "success",
        title: "Sukses",
        text: "Data Kelas berhasil Diupdate",
      });
    </script>
  <?php endif; ?>

  <?php
  if (isset($_GET['hapus'])) : ?>
    <script>
      Swal.fire({
        icon: "success",
        title: "Sukses",
        text: "Data Kelas berhasil Dihapus",
      });
    </script>
  <?php endif; ?>
  <!-- akhir alert -->

  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../assets/img/logo.jpeg" class="navbar-brand-img h-100 rounded-circle" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Dashboard Admin</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link text-white " href="dashboard.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white " href="bulan.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">brightness_2</i>
            </div>
            <span class="nav-link-text ms-1">Data Bulan</span>
          </a>

        <li class="nav-item">
          <a class="nav-link text-white " href="kelas.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">school</i>
            </div>
            <span class="nav-link-text ms-1">Data Kelas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="siswa.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">person</i>
            </div>
            <span class="nav-link-text ms-1">Data Siswa</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="pembayaran.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">notifications</i>
            </div>
            <span class="nav-link-text ms-1">Data Pembayaran</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="tagihan.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Data Tagihan</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-primary w-100" href="logout.php" type="button" onclick=" return confirm ('Yakin ingin logout ?');">Logout</a>
      </div>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Data Siswa</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Data Siswa</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <label class="form-label text-2xl text-bold text-primary">Selamat Datang Admin 👋</label>
          </div>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <div class="row">
        <div class="mb-5">
          <a href="functions/tambahSiswa.php" class="p-3 rounded-2 bg-gradient-primary text-white text-bold">Tambah Data Siswa</a>
          <a href="cetak/cetaksiswa.php" class="p-3 rounded-2 bg-gradient-primary text-white text-bold">Print Data Siswa</a>
        </div>
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Table Data Siswa</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No.</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NISN</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIS</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor Telepon</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kelas</th>
                      <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder opacity-7">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $nom = 1;
                    while ($siswa = $hasil->fetch_assoc()) :
                    ?>
                      <tr>
                        <td class="text-center"><?= $nom++ ?></td>
                        <td class="align-middle text-center text-sm"><?= $siswa['nisn'] ?></td>
                        <td class="align-middle text-center text-sm"><?= $siswa['nis'] ?></td>
                        <td class="align-middle text-center text-sm"><?= $siswa['nama'] ?></td>
                        <td class="align-middle text-center text-sm"><?= $siswa['alamat'] ?></td>
                        <td class="align-middle text-center text-sm"><?= $siswa['no_telepon'] ?></td>
                        <td class="align-middle text-center text-sm"><?= $siswa['nama_kelas'] ?></td>
                        <td class="align-middle text-center text-sm">
                          <a href="functions/editSiswa.php?id=<?= $siswa['nisn'] ?>"><i class="material-icons">edit</i></a>
                          <a href="functions/hapusSiswa.php?id=<?= $siswa['nisn'] ?>" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus data Ini ?');"><i class="material-icons">delete</i></a>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="" class="font-weight-bold" target="_blank">Auliya Ikhsana</a>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>