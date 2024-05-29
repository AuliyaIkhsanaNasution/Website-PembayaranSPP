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
    $id = htmlspecialchars($_POST["id"]);
    $harga = htmlspecialchars($_POST["harga"]);
    $fasilitas = htmlspecialchars($_POST["fasilitas"]);
    $status = htmlspecialchars($_POST["status"]);

    // pengecekan id apakah ada di database
    $result = mysqli_query($conn, "SELECT id_kamar FROM kamar_kost WHERE id_kamar='$id'");

    if (mysqli_fetch_assoc($result)) {
        header("location: ?gagal=true");
        exit;
    }

    $query = "INSERT INTO kamar_kost VALUES ('$id', '$harga', '$fasilitas', '$status' )";

    if ($conn->query($query) === TRUE) {
        header("location: ../kamar.php?tambah=true");
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
                <h4 class="font-weight-bolder text-5xl text-primary text-center">Tambah Data Kamar</h4>
            </div>

            <!-- alert -->
            <?php
            if (isset($_GET['gagal'])) : ?>
                <script>
                    alert("ID Kamar Sudah Terdaftar!");
                </script>
            <?php endif; ?>


            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="id" class="text-lg text-dark text-bold">ID Kamar</label>
                        <input type="text" name="id" style="border: 2px solid gray;" class="form-control form-control-lg" placeholder="ID/No Kamar Kost" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="text-lg text-dark text-bold">Harga Sewa</label>
                        <input type="text" name="harga" style="border: 2px solid gray;" class="form-control form-control-lg" placeholder="Harga Kamar Kost" required>
                    </div>
                    <div class="mb-3">
                        <label for="fasilitas" class="text-lg text-dark text-bold">Fasilitas</label>
                        <input type="text" name="fasilitas" style="border: 2px solid gray;" class="form-control form-control-lg" placeholder="Fasilitas Kamar Kost">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="text-lg text-dark text-bold">Status</label>
                        <select name="status" id="status" class="form-control form-control-lg" required style="border: 2px solid gray;">
                            <option selected>--Pilih Status--</option>
                            <option value="tersedia">Tersedia</option>
                            <option value="disewa">Disewa</option>
                        </select>
                    </div>


                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Tambahkan Data</button>
                    </div>
                    <p class="text-sm mt-3 mb-0">Tidak ingin menambahkan data? <a href="../kamar.php" class="text-dark font-weight-bolder">kembali</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>