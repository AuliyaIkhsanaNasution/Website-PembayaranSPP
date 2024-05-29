
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/logo.jpeg">
  <title>
    Dashboard Siswa Pembayaran SPP Smart School
  </title>
  <!-- icons google -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
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
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../assets/img/logo.jpeg" class="navbar-brand-img h-100 rounded-circle" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">Dashboard Siswa</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">

      <li class="nav-item">
          <a class="nav-link text-white active bg-gradient-primary" href="dashboard.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link text-white" href="kelas.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">school</i>
            </div>
            <span class="nav-link-text ms-1">Data Kelas</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="siswa.php">
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
          <a class="nav-link text-white " href="tunggakan.php">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Data Tunggakan</span>
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <label class="form-label text-2xl text-bold text-primary">Selamat Datang Siswa 👋</label>
          </div>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Dashboard Pembayaran SPP Smart School</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Card Jumlah Siswa -->
            <div class="bg-white rounded-lg p-4 shadow-md">
                <h3 class="text-lg font-semibold mb-2">Jumlah Siswa</h3>
                <p class="text-3xl font-bold">[Jumlah Siswa]</p>
            </div>
            <!-- Card Jumlah Kelas -->
            <div class="bg-white rounded-lg p-4 shadow-md">
                <h3 class="text-lg font-semibold mb-2">Jumlah Kelas</h3>
                <p class="text-3xl font-bold">[Jumlah Kelas]</p>
            </div>
            <!-- Card Total Pemasukan SPP -->
            <div class="bg-white rounded-lg p-4 shadow-md">
                <h3 class="text-lg font-semibold mb-2">Total Pemasukan SPP</h3>
                <p class="text-3xl font-bold">[Total Pemasukan SPP]</p>
            </div>
        </div>
        <div >
            <h3 class="text-lg font-semibold mt-4 " >Dashboard Pembayaran SPP Smart School</h3>
            <p>Ini adalah dashboard untuk sistem pembayaran SPP di Smart School.</p>
            <!-- Ganti dengan logo yang sesuai -->
            <img src="../assets/img/logo.jpeg" alt="Logo Smart School" style="width: 100px">
        </div>
    </div>
  </main>


  <!-- alert -->
  <?php
  if (isset($_GET['tambah'])) : ?>
    <script>
      alert("Data Berhasil Ditambahkan");
    </script>
  <?php endif; ?>

  <?php
  if (isset($_GET['ubah'])) : ?>
    <script>
      alert("Data Berhasil Diupdate");
    </script>
  <?php endif; ?>

  <?php
  if (isset($_GET['hapus'])) : ?>
    <script>
      alert("Data Berhasil Dihapus");
    </script>
  <?php endif; ?>
  <!-- akhir alert -->
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