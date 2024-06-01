<?php
require "koneksi.php";
session_start();

// pemeriksaan session login
if (!isset($_SESSION["loginsiswa"])) {
    header("Location: ../../../index.php");
    exit;
}

// pemeriksaan lunas
$cekLunas = "SELECT * FROM tagihan WHERE nisn = '$_SESSION[nisn]' AND status = 'LUNAS'";
$cekLunas = mysqli_query($conn, $cekLunas);
if (mysqli_num_rows($cekLunas) > 0) {
    header("Location: ../tagihan.php?lunas=true");
    exit;
}



// memanggil apabila tombol submit di klik
if (isset($_POST["submit"])) {
    $idTagihan = $_POST["idTagihan"];
    $jumlah = $_POST["jumlah"];
    $va = htmlspecialchars($_POST["va"]);
    $bukti = $_FILES["bukti"]["name"];
    $buktiSize = $_FILES["bukti"]["size"];
    $tmpName = $_FILES["bukti"]["tmp_name"];

    // cek apakah yang diupload adalah gambar
    $validExtension = ['jpeg', 'jpg', 'png'];
    $extension = explode('.', $bukti);
    $extension = strtolower(end($extension));
    if (!in_array($extension, $validExtension)) {
        echo "<script>
                    alert('Yang anda upload bukan gambar!');
                  </script>";
        return false;
    }

    // cek jika ukuran gambar terlalu besar
    if ($buktiSize > 2000000) {
        echo "<script>
                    alert('Ukuran gambar terlalu besar!');
                  </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $newFileName = uniqid();
    // $newFileName .= '.';
    // $newFileName .= $extension;
    move_uploaded_file($tmpName, '../../assets/img/bukti/' . $newFileName . '.' . $extension);

    // insert ke pembayaran
    $queryInsert = "INSERT INTO pembayaran (id_pembayaran, id_tagihan, tanggal_pembayaran, jumlah, status, bukti, va) VALUES ('', '$idTagihan', NOW(), $jumlah, 'Belum Dikonfirmasi', '$newFileName.$extension', '$va')";

    // update tagihan
    $queryUpdate = "UPDATE tagihan SET status = 'DIPERIKSA' WHERE id_tagihan = '$idTagihan'";

    if (mysqli_query($conn, $queryInsert) && mysqli_query($conn, $queryUpdate)) {
        header("Location: ../tagihan.php?bukti=true");
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
    <title>Upload Bukti Pembayaran</title>
    <link rel="icon" type="image/png" href="../../assets/img/logo.jpeg" />

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
                <h4 class="font-weight-bolder text-5xl text-primary text-center">Upload Bukti</h4>
                <p class="text-danger text-sm">*NB : Harap upload bukti pembayaran dengan jelas. Kesalahan pengiriman bukti berakibat pada SPP tidak terbayar !!!</p>
            </div>

            <!-- alert -->
            <?php
            if (isset($_GET['gagal'])) : ?>
                <script>
                    alert("ID Kamar Sudah Terdaftar!");
                </script>
            <?php endif; ?>

            <?php
            // ambil data tagihan
            $queryTagihan = "SELECT * FROM tagihan WHERE id_tagihan = '$_GET[id]'";
            $resultTagihan = mysqli_query($conn, $queryTagihan);
            $tagihan = mysqli_fetch_assoc($resultTagihan);
            ?>


            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="idTagihan" id="idTagihan" value="<?= $_GET['id'] ?>">
                    <input type="hidden" name="jumlah" id="jumlah" value="<?= $tagihan['jumlah'] ?>">
                    <div class="mb-3">
                        <label for="va" class="text-lg text-dark text-bold">Masukkan VA</label>
                        <input type="text" name="va" style="border: 2px solid gray;" class="form-control form-control-lg" value="<?= $tagihan['tagihan'] ?>" readonly autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="bukti" class="text-lg text-dark text-bold">Masukkan Bukti</label>
                        <p>File harus berformat image (jpg, jpeg, png)</p>
                        <input type="file" name="bukti" style="border: 2px solid gray;" class="form-control form-control-lg" placeholder="VA Tagihan..." required autocomplete="off" accept="image/jpg, image/jpeg, image/png">
                    </div>


                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Tambahkan Data</button>
                    </div>
                    <p class="text-sm mt-3 mb-0">Tidak ingin mengupload data? <a href="../tagihan.php" class="text-dark font-weight-bolder">kembali</a></p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>