<?php
require "koneksi.php";
session_start();

// pemeriksaan session login
if (!isset($_SESSION["login"])) {
    header("Location: ../../login.php");
    exit;
}

$id_kelas = $_GET["id"];

if (!$id_kelas) {
    header("Location: ../kelas.php");
    exit;
}

// menghapus data kelas berdasarkan id_kelas
$query = "DELETE FROM kelas WHERE id_kelas = '$id_kelas'";

if ($conn->query($query) === TRUE) {
    header("Location: ../kelas.php?hapus=true");
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
?>
