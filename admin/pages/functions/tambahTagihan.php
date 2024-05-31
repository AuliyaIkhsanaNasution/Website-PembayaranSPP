<?php
require "koneksi.php";
session_start();

// pemeriksaan session login
if (!isset($_SESSION["login"])) {
    header("Location: ../../../index.php");
    exit;
}

// memanggil apabila tombol submit di klik
if (isset($_POST["submit"])) {
    $bulan = $_POST["bulan"];
    list($year, $month) = explode("-", $bulan);
    $id_bulan = (int)$month;

    $rand = rand(1, 999);

    // update tagihan
    // ambil siswa lalu looping
    $siswa = mysqli_query($conn, "SELECT * FROM siswa");
    while ($data = mysqli_fetch_array($siswa)) {
        $nisn = $data["nisn"];

        // menggabungkan dan memastikan rand + nisn
        $tagihan = str_pad($rand, 3, "0", STR_PAD_LEFT) . $nisn;

        // update tagihan untuk setiap nisn
        $update = mysqli_query($conn, "UPDATE tagihan SET id_bulan = $id_bulan, tagihan = '$tagihan', status = 'BELUM' WHERE nisn = '$nisn'");
    }

    if ($update) {
        header("Location: ../tagihan.php?konfirmasi=true");
    } else {
        echo mysqli_error($conn);
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kamar</title>
    <link rel="icon" type="image/png" href="../../assets/img/logo-kost.jpg" />

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- icons google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="bg-primary">
    <div class="container  bg-white  rounded-3 my-7 m-auto w-60">
        <div class="card card-plain">
            <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder text-5xl text-primary text-center">Tambah Tagihan</h4>
            </div>

            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="bulan" class="text-lg text-dark text-bold">Masukkan Bulan Tagihan</label>
                        <input type="month" name="bulan" style="border: 2px solid gray;" class="form-control form-control-lg" placeholder="Masukkan Bulan Tagihan..." required autocomplete="off">
                    </div>

                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Buat Tagihan</button>
                    </div>
                    <p class="text-sm mt-3 mb-0">Tidak ingin membuat tagihan? <a href="../tagihan.php" class="text-dark font-weight-bolder">kembali</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>