<?php
require "functions.php";
session_start();

// pemeriksaan session login
if (!isset($_SESSION["login"])) {
    header("Location: ../../../index.php");
    exit;
}

$nik = $_GET["nik"];
// query data penyewa berdasarkan nik
$sql = "SELECT * FROM penyewa WHERE nik = '$nik'";
$hasil = $conn->query($sql);


// memanggil apabila tombol ubah di klik
if (isset($_POST["ubah"])) {
    $nama = htmlspecialchars($_POST["nama"]);
    $alamat = htmlspecialchars($_POST["alamat"]);
    $no_hp = htmlspecialchars($_POST["no_hp"]);
    $kode = htmlspecialchars($_POST["kode"]);

    $query = "UPDATE penyewa SET
        nama = '$nama',
        alamat = '$alamat',
        no_hp = '$no_hp',
        kode_sewa = '$kode'
    WHERE nik = '$nik'";

    if (mysqli_query($conn, $query) === TRUE) {
        header("location: ../penyewa.php?ubah=true");
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
    <title>Ubah Data Penyewa</title>
    <link rel="icon" type="image/png" href="../../assets/img/logo.jpg" />


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
    <div class="container  bg-white  rounded-3 my-7 mt-7 m-auto w-60">
        <div class="card card-plain">
            <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder text-5xl text-primary text-center">Ubah Data Penyewa</h4>
            </div>

            <div class="card-body">
                <?php while ($sewa = $hasil->fetch_assoc()) : ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nik" class="text-lg text-dark text-bold">NIK</label>
                            <input type="text" name="nik" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $sewa['nik'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="text-lg text-dark text-bold">Nama</label>
                            <input type="text" name="nama" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $sewa['nama'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="text-lg text-dark text-bold">Alamat (KTP)</label>
                            <input type="text" name="alamat" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $sewa['alamat'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="text-lg text-dark text-bold">Nomor HP</label>
                            <input type="text" name="no_hp" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $sewa['no_hp'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="kode" class="text-lg text-dark text-bold">Kode Sewa</label>
                            <input type="text" name="kode" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $sewa['kode_sewa'] ?>">
                        </div>


                        <div class="text-center">
                            <button type="submit" name="ubah" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Update Data</button>
                        </div>
                        <p class="text-sm mt-3 mb-0">Tidak ingin mengubah penyewa? <a href="../penyewa.php" class="text-dark font-weight-bolder">kembali</a></p>
                    </form>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>