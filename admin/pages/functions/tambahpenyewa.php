<?php
require "functions.php";
session_start();

// pemeriksaan session login
if (!isset($_SESSION["login"])) {
    header("Location: ../../../index.php");
    exit;
}

// memanggil apabila tombol submit di klik
if (isset($_POST["submit"])) {
    $nik = htmlspecialchars($_POST["nik"]);
    $nama = htmlspecialchars($_POST["nama"]);
    $alamat = htmlspecialchars($_POST["alamat"]);
    $no_hp = htmlspecialchars($_POST["no_hp"]);
    $kode = htmlspecialchars($_POST["kode"]);

    // pengecekan id apakah ada di database
    $result = mysqli_query($conn, "SELECT nik FROM penyewa WHERE nik='$nik'");

    if (mysqli_fetch_assoc($result)) {
        header("location: ?gagal=true");
        exit;
    }

    $query = "INSERT INTO penyewa VALUES ('$nik', '$nama', '$alamat', '$no_hp', '$kode' )";

    if ($conn->query($query) === TRUE) {
        header("location: ../penyewa.php?tambah=true");
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Penyewa</title>
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
                <h4 class="font-weight-bolder text-5xl text-primary text-center">Tambah Data Penyewa</h4>
            </div>

            <!-- alert -->
            <?php
            if (isset($_GET['gagal'])) : ?>
                <script>
                    alert("NIK Penyewa Sudah Terdaftar!");
                </script>
            <?php endif; ?>


            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="nik" class="text-lg text-dark text-bold">NIK</label>
                        <input type="text" name="nik" style="border: 2px solid gray;" class="form-control form-control-lg" placeholder="NIK Penyewa" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="text-lg text-dark text-bold">Nama</label>
                        <input type="text" name="nama" style="border: 2px solid gray;" class="form-control form-control-lg" placeholder="Nama Penyewa" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="text-lg text-dark text-bold">Alamat (KTP)</label>
                        <input type="text" name="alamat" style="border: 2px solid gray;" class="form-control form-control-lg" placeholder="Alamat Asal Penyewa">
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="text-lg text-dark text-bold">Nomor HP</label>
                        <input type="text" name="no_hp" style="border: 2px solid gray;" class="form-control form-control-lg" placeholder="Nomor HP Penyewa">
                    </div>
                    <div class="mb-3">
                        <label for="kode" class="text-lg text-dark text-bold">Kode Sewa</label>
                        <input type="text" name="kode" style="border: 2px solid gray;" class="form-control form-control-lg" placeholder="Masukkan Kode Sewa yang diberikan Pemilik Kost">
                    </div>


                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Tambahkan Data</button>
                    </div>
                    <p class="text-sm mt-3 mb-0">Tidak ingin menambahkan penyewa? <a href="../penyewa.php" class="text-dark font-weight-bolder">kembali</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>