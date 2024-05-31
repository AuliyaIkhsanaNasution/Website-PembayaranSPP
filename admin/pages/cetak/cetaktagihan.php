<?php
require "../functions/koneksi.php";
require '../../vendor/autoload.php';
session_start();

use Dompdf\Dompdf;

// Verifikasi sesi login
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


$username = $_SESSION['username'];

// Mengambil data dari tabel kelas
$query = "SELECT tagihan.id_tagihan, tagihan.tagihan, siswa.nisn, siswa.nama, kelas.nama_kelas, bulan.nama_bulan, tagihan.jumlah, tagihan.status
FROM tagihan 
JOIN siswa ON tagihan.nisn = siswa.nisn
JOIN kelas ON siswa.id_kelas = kelas.id_kelas
JOIN bulan ON tagihan.id_bulan = bulan.id_bulan";
$hasil = $conn->query($query);

// Menyiapkan konten HTML
$html = '
<!DOCTYPE html>
<html>
<head>
    <style>
        .header {background-color: #FF5580; text-align: left; }
        .header img { float: left; margin-right: 20px; }
        .header h1 { text-align: center; margin: 0; }
        .header p { text-align: center; margin: 0; }
        .content { text-align: center; margin: 0}
        .content h2 { text-align: center; margin: 0; }
        .content p { text-align: center; margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table th { background-color: ##c7d2fe; }
        table, th, td { border: 2px solid black; }
        th, td { padding: 10px; text-align: center; }
        .footer { margin-top: 50px; }
        .footer .left, .footer .right { display: inline-block; width: 45%; margin: 0;}
        .footer .right {float: right; text-align: right; margin:0 ; }
        .footer .left p, .footer .right p { margin: 0; }
        .footer .sign { margin-top: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Smart School</h1>
        <p> Jl. Pertahanan No.99, Sigara Gara, Kec. Patumbak, Kabupaten Deli Serdang, Sumatera Utara 20361</p>
        <p>Telepon: 0123-456789</p>
        <hr>
    </div>
    <div class="content">
        <h2>Data Tagihan</h2>
        <p>Periode: ' . date('F Y') . '</p>
        <table>
            <thead>
                <tr>
                <th>No</th>
                <th>ID Tagihan</th>
                <th>Tagihan</th>
                <th>NISN</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Bulan</th>
                <th>Jumlah</th>
                <th>Status</th>
                </tr>
            </thead>
            <tbody>';

$num = 1;
while ($row = $hasil->fetch_assoc()) {
    $html .= '
    <tr>
    <td>' . $num++ . '</td>
    <td>' . $row['id_tagihan'] . '</td>
    <td>' . $row['tagihan'] . '</td>
    <td>' . $row['nisn'] . '</td>
    <td>' . $row['nama'] . '</td>
    <td>' . $row['nama_kelas'] . '</td>
    <td>' . $row['nama_bulan'] . '</td>
    <td>' . $row['jumlah'] . '</td>
    <td>' . $row['status'] . '</td>
    </tr>';
}

$html .= '
            </tbody>
        </table>
    </div>
    <div class="footer">
        <div class="left">
        <p>Disetujui oleh,</p>
            <p>Kepala Sekolah</p>
            <div class="sign">(Muhammad Bobby)</div>
        </div>
        <div class="right">
        <p>Medan, ' . date('d F Y') . '</p>
            <p>Dibuat Oleh</p>
            <p>Administrator</p>
            <div class="sign">( ' . $username . ' )</div>
        </div>
    </div>
</body>
</html>';


// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'potrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('Data-Kelas.pdf', array("Attachment" => false));
?>
