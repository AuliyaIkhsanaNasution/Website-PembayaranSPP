<?php
require "functions.php";



$id = $_GET["id"];
// query data penyewa berdasarka id
$sql = "SELECT * FROM konfirmasi, penyewa WHERE konfirmasi.id_transaksi = '$id' AND
        konfirmasi.id_penyewa = penyewa.nik";
$hasil = $conn->query($sql);

while ($row = $hasil->fetch_assoc()) {
    $id = $row['id_transaksi'];
    $id_penyewa = $row['id_penyewa'];
    $id_kamar = $row['id_kamar'];
    $tanggal_pembayaran = $row['tanggal_pembayaran'];
    $jumlah_bayar = $row['jumlah_bayar'];
}


// pengecekan sebelum konfirmasi
$kamar = query("SELECT * FROM kamar_kost WHERE id_kamar = '$id_kamar'")[0];

if ($kamar['status'] == 'tersedia') {
    $updatekamar = "UPDATE kamar_kost SET status = 'disewa'
        WHERE id_kamar = '$id_kamar'";

    $query = "INSERT INTO transaksi   VALUES ('$id', '$id_penyewa', '$id_kamar', '$tanggal_pembayaran' , $jumlah_bayar )";

    $updatedesk = "UPDATE konfirmasi SET desk = 'Pesanan Telah Dikonfirmasi'
        WHERE id_transaksi = '$id'";
}

if ($conn->query($query) === TRUE && $conn->query($updatedesk) === TRUE && $conn->query($updatekamar) === TRUE) {
    header("location: ../transaksi.php?tambah=true");
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
