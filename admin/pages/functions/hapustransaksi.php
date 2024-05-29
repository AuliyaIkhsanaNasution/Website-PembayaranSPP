<?php
require "functions.php";

$id = $_GET["id"];
$kamar = $_GET["kamar"];
$query = "DELETE FROM transaksi WHERE id_transaksi = '$id'";

$updatekamar = "UPDATE kamar_kost SET status = 'tersedia'
WHERE id_kamar = '$kamar'";

if (mysqli_query($conn, $query) === TRUE && mysqli_query($conn, $updatekamar) === TRUE) {
    header("location: ../penyewa.php?hapus=true");
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
