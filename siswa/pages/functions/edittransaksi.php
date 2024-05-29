<?php
require "functions.php";
session_start();

// pemeriksaan session login
if (!isset($_SESSION["login"])) {
    header("Location: ../../../index.php");
    exit;
}

$id = $_GET["id"];
// query data penyewa berdasarkan nik
$sql = "SELECT * FROM transaksi, penyewa WHERE id_transaksi = '$id' AND transaksi.id_penyewa = penyewa.nik";
$hasil = $conn->query($sql);


// memanggil apabila tombol ubah di klik
if (isset($_POST["ubah"])) {
    $penyewa = htmlspecialchars($_POST["penyewa"]);
    $kamar = htmlspecialchars($_POST["kamar"]);
    $kamarlama = htmlspecialchars($_POST["kamarlama"]);
    $tanggal = htmlspecialchars($_POST["tanggal"]);
    $harga = htmlspecialchars($_POST["harga"]);

    $query = "UPDATE transaksi SET
        id_penyewa = '$penyewa',
        id_kamar = '$kamar',
        tanggal_pembayaran = '$tanggal',
        jumlah_bayar = $harga
    WHERE id_transaksi = '$id'";

    $updatekamarlama = "UPDATE kamar_kost SET status = 'tersedia'
WHERE id_kamar = '$kamarlama'";

    $updatekamarbaru = "UPDATE kamar_kost SET status = 'disewa'
WHERE id_kamar = '$kamar'";

    if (mysqli_query($conn, $query) === TRUE && mysqli_query($conn, $updatekamarlama) === TRUE && mysqli_query($conn, $updatekamarbaru) === TRUE) {
        header("location: ../transaksi.php?ubah=true");
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
                            <label for="id" class="text-lg text-dark text-bold">ID Transaksi</label>
                            <input type="text" name="id" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $sewa['id_transaksi'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="penyewa" class="text-lg text-dark text-bold">Penyewa</label>
                            <select name="penyewa" id="penyewa" class="form-control form-control-lg" style="border: 2px solid gray;" required>
                                <option selected value="<?= $sewa['id_penyewa'] ?>"><?= $sewa['nama'] ?></option>
                                <?php

                                $queryplg = "SELECT * FROM penyewa";
                                $hasilplg = $conn->query($queryplg);
                                while ($plg = $hasilplg->fetch_assoc()) :
                                ?>
                                    <option value="<?= $plg['nik'] ?>"><?= $plg['nama'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <input type="hidden" value="<?= $sewa['id_kamar'] ?>" name="kamarlama">
                        <div class="mb-3">
                            <label for="kamar" class="text-lg text-dark text-bold">Kamar</label>
                            <p class="text-xxs text-dark">ID - Harga</p>
                            <select name="kamar" id="kamar" class="form-control form-control-lg" style="border: 2px solid gray;" required>
                                <option selected value="<?= $sewa['id_kamar'] ?>"><?= $sewa['id_kamar'] ?></option>
                                <?php

                                $querykmr = "SELECT * FROM kamar_kost WHERE status = 'tersedia'";
                                $hasilkmr = $conn->query($querykmr);
                                while ($kmr = $hasilkmr->fetch_assoc()) :
                                ?>
                                    <option value="<?= $kmr['id_kamar'] ?>"><?= $kmr['id_kamar'] ?> - <?= $kmr['harga_sewa'] ?></option>

                                <?php
                                    $harga = $kmr['harga_sewa'];
                                endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="text-lg text-dark text-bold">Tanggal Sewa</label>
                            <input type="date" name="tanggal" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $sewa['tanggal_pembayaran'] ?>">
                        </div>

                        <?php if (isset($harga)) : ?>
                            <div class="mb-3">
                                <label for="harga" class="text-lg text-dark text-bold">Jumlah Bayar</label>
                                <input type="text" name="harga" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $harga ?>" readonly>
                            </div>
                        <?php endif; ?>


                        <div class="text-center">
                            <button type="submit" name="ubah" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Update Data</button>
                        </div>
                        <p class="text-sm mt-3 mb-0">Tidak ingin menambahkan penyewa? <a href="../penyewa.php" class="text-dark font-weight-bolder">kembali</a></p>
                    </form>
                <?php endwhile; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>