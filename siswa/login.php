<?php
require "pages/functions/koneksi.php";
session_start();

if (isset($_SESSION["loginsiswa"])) {
    header("Location: pages/dashboard.php");
    exit;
}

// Memproses login ketika tombol login ditekan
if (isset($_POST["loginsiswa"])) {
    // Mengambil nilai NISN dan NIS dari form login
    $nisn = $_POST["nisn"];
    $nis = $_POST["nis"];

    // Eksekusi query SQL untuk memeriksa kecocokan username dan password
    $result = mysqli_query($conn, "SELECT * FROM siswa WHERE nisn = '$nisn' AND nis = '$nis'");
    $cek = mysqli_num_rows($result);

    if ($cek > 0) {
        // Fetch the user data
        $row = mysqli_fetch_assoc($result);

        // Jika data ditemukan, set sesi login dan redirect ke halaman utama
        $_SESSION["loginsiswa"] = true;
        $_SESSION["nama"] = $row['nama']; // Assuming 'nama' is the column for the user's name
        $_SESSION["nisn"] = $row['nisn'];

        header("Location: pages/dashboard.php");
        exit;
    } else {
        // Jika data tidak ditemukan, atur pesan kesalahan
        $error_message = "NISN atau NIS salah. Silakan coba lagi.";
    }
}
?>


<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login Siswa</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="bg-blue-900 absolute top-0 left-0 bg-gradient-to-b from-gray-900 via-gray-900 to-blue-800 bottom-0 leading-5 h-full w-full overflow-hidden"></div>
    <div class="relative min-h-screen sm:flex sm:flex-row justify-center bg-transparent rounded-3xl shadow-xl">
        <div class="flex-col flex self-center lg:px-14 sm:max-w-4xl xl:max-w-md z-10">
            <div class="self-start hidden lg:flex flex-col text-gray-300">
                <h1 class="my-3 font-semibold text-4xl">Selamat Datang Kembali</h1>
                <p class="pr-3 text-sm opacity-75">Selamat Datang di login siswa untuk melakukan pembayaran SPP Smart School</p>
            </div>
        </div>
        <div class="flex justify-center self-center z-10">
            <div class="p-12 bg-white mx-auto rounded-3xl w-96">
                <div class="mb-7">
                    <h3 class="font-semibold text-2xl text-gray-800">Login Siswa</h3>
                    <p class="text-gray-400">Masuk untuk Bayar SPP</p>
                </div>
                <?php if (isset($error_message)) : ?>
                    <div class="mb-4 text-red-500">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="space-y-6">
                        <div>
                            <label for="nisn">NISN Siswa</label>
                            <input class="w-full text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400" type="text" name="nisn" placeholder="Masukkan NISN" required>
                        </div>
                        <div>
                            <label for="nis">NIS Siswa</label>
                            <input class="w-full text-sm px-4 py-3 bg-gray-200 focus:bg-gray-100 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-400" type="text" name="nis" placeholder="Masukkan NIS" required>
                        </div>
                        <div>
                            <button type="submit" name="loginsiswa" class="w-full flex justify-center bg-blue-800 hover:bg-blue-700 text-gray-100 p-3 rounded-lg tracking-wide font-semibold cursor-pointer transition ease-in duration-500">
                                Masuk
                            </button>
                        </div>
                    </div>
                </form>
                <div class="flex items-center justify-center space-x-2 my-5">
                    <span class="h-px w-16 bg-gray-100"></span>
                    <span class="h-px w-16 bg-gray-100"></span>
                </div>
                Bukan siswa? <a href="../index.php" class="text-purple-500">klik kembali</a>
            </div>
        </div>
    </div>
    <svg class="absolute bottom-0 left-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#fff" fill-opacity="1" d="M0,0L40,42.7C80,85,160,171,240,197.3C320,224,400,192,480,154.7C560,117,640,75,720,74.7C800,75,880,117,960,154.7C1040,192,1120,224,1200,213.3C1280,203,1360,149,1400,122.7L1440,96L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z"></path>
    </svg>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>

</html>