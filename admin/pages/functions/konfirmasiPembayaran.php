<?php
require 'koneksi.php';
session_start();

$id_pembayaran = $_GET['id_pembayaran'];
$id_tagihan = $_GET['id_tagihan'];

// update pembayaran
$pembayaran = "UPDATE pembayaran SET status = 'Dikonfirmasi' WHERE id_pembayaran = '$id_pembayaran'";

// update tagihan
$tagihan = "UPDATE tagihan SET status = 'LUNAS', tagihan = '-' WHERE id_tagihan = '$id_tagihan'";

if (mysqli_query($conn, $pembayaran) && mysqli_query($conn, $tagihan)) {
    header("Location: ../pembayaran.php?konfirmasi=true");
} else {
    echo mysqli_error($conn);
}
