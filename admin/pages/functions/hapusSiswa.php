<?php
require "koneksi.php";

$nisn = $_GET["id"];
$querySiswa = "DELETE FROM siswa WHERE nisn = '$nisn'";
$queryTagihan = "DELETE FROM tagihan WHERE nisn = '$nisn'";

if ($conn->query($queryTagihan) === TRUE) {
    if ($conn->query($querySiswa) === TRUE) {
        header("location: ../siswa.php?hapus=true");
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
