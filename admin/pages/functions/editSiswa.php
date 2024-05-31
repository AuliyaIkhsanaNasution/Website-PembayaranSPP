<?php
require "koneksi.php";
session_start();

// pemeriksaan session login
if (!isset($_SESSION["login"])) {
    header("Location: ../../../index.php");
    exit;
}

$nisn = $_GET["id"];

// memanggil apabila tombol submit di klik
if (isset($_POST["submit"])) {
    $nisn = htmlspecialchars($_POST["nisn"]);
    $nis = htmlspecialchars($_POST["nis"]);
    $nama = htmlspecialchars($_POST["nama"]);
    $alamat = htmlspecialchars($_POST["alamat"]);
    $no_telepon = htmlspecialchars($_POST["no_hp"]);
    $id_kelas = htmlspecialchars($_POST["kelas"]);
    $spp = htmlspecialchars($_POST["spp"]);



    // update siswa
    $siswaQuery = "UPDATE siswa SET nama = '$nama', alamat = '$alamat', no_telepon = '$no_telepon', id_kelas = $id_kelas, spp = $spp WHERE nisn = '$nisn'";

    // update tagihan
    $tagihanQuery = "UPDATE tagihan SET id_kelas = $id_kelas, jumlah = $spp WHERE nisn = '$nisn'";

    if ($conn->query($siswaQuery) === TRUE && $conn->query($tagihanQuery) === TRUE) {
        header("location: ../siswa.php?ubah=true");
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
    <title>Edit Data Siswa</title>
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
                <h4 class="font-weight-bolder text-5xl text-primary text-center">Edit Data Siswa</h4>
            </div>

            <?php
            $siswa = mysqli_query($conn, "SELECT * FROM siswa 
            JOIN tagihan ON siswa.nisn = tagihan.nisn
            JOIN kelas ON siswa.id_kelas = kelas.id_kelas
            WHERE siswa.nisn = '$nisn'");
            while ($data = mysqli_fetch_array($siswa)) :
            ?>

                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nisn" class="text-lg text-dark text-bold">NISN</label>
                            <input type="text" name="nisn" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $data['nisn'] ?>" readonly autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="nis" class="text-lg text-dark text-bold">NIS</label>
                            <input type="text" name="nis" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $data['nis'] ?>" readonly autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="text-lg text-dark text-bold">Nama</label>
                            <input type="text" name="nama" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $data['nama'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="text-lg text-dark text-bold">Alamat Domisili</label>
                            <input type="text" name="alamat" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $data['alamat'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_hp" class="text-lg text-dark text-bold">Nomor HP</label>
                            <input type="text" name="no_hp" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $data['no_telepon'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="spp" class="text-lg text-dark text-bold">Jumlah Tagihan SPP per Bulan</label>
                            <input type="text" name="spp" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $data['spp'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="text-lg text-dark text-bold">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control form-control-lg" style="border: 2px solid gray;">
                                <option value="<?= $data['id_kelas'] ?>"><?= $data['nama_kelas'] ?></option>
                                <?php
                                $kelas = mysqli_query($conn, "SELECT * FROM kelas WHERE id_kelas != '$data[id_kelas]'");
                                while ($kls = mysqli_fetch_array($kelas)) :
                                ?>
                                    <option value="<?= $kls['id_kelas'] ?>"><?= $kls['nama_kelas'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Update Siswa</button>
                        </div>
                        <p class="text-sm mt-3 mb-0">Tidak ingin mengubah siswa? <a href="../siswa.php" class="text-dark font-weight-bolder">kembali</a></p>
                    </form>
                <?php endwhile; ?>
                </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>