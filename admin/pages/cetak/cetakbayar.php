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

// Mengambil data dari tabel pembayaran dengan query yang diminta
$query = "SELECT *, pembayaran.status AS konfirmasi FROM pembayaran
JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan
JOIN siswa ON tagihan.nisn = siswa.nisn
JOIN kelas ON siswa.id_kelas = kelas.id_kelas
JOIN bulan ON tagihan.id_bulan = bulan.id_bulan
ORDER BY pembayaran.id_pembayaran DESC";

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
        table th { background-color: #c7d2fe; }
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
        <h2>Data Pembayaran</h2>
        <p>Periode: ' . date('F Y') . '</p>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Tagihan</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Jumlah</th>
                    <th>VA</th>
                    <th>Konfirmasi</th>
                </tr>
            </thead>
            <tbody>';

$num = 1;
while ($pembayaran = $hasil->fetch_assoc()) {
    $html .= '
    <tr>
        <td class="text-center">' . $num++ . '</td>
        <td class="align-middle text-center text-sm text-bold">' . $pembayaran['id_tagihan'] . '</td>
        <td class="align-middle text-center text-sm text-bold">' . $pembayaran['nama'] . '</td>
        <td class="align-middle text-center text-sm text-bold">' . $pembayaran['nama_kelas'] . '</td>
        <td class="align-middle text-center text-sm text-bold">' . $pembayaran['tanggal_pembayaran'] . '</td>
        <td class="align-middle text-center text-sm text-bold">Rp ' . number_format($pembayaran['jumlah'], 0, ',', '.') . '</td>
        <td class="align-middle text-center text-sm text-bold">' . $pembayaran['va'] . '</td>
        <td class="align-middle text-center text-sm text-bold">' . $pembayaran['konfirmasi'] . '</td>
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
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('Data-Pembayaran.pdf', array("Attachment" => false));
?>
