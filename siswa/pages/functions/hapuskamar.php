<?php
require "functions.php";

$id = $_GET["id"];
$query = "DELETE FROM kamar_kost WHERE id_kamar = '$id'";

if (mysqli_query($conn, $query) === TRUE) {
    header("location: ../kamar.php?hapus=true");
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}
