<?php
session_start();
$_SESSION["loginsiswa"] = [];
session_unset();
session_destroy();

// menghapus cookie
setcookie("nk", "", time() - 300);
setcookie("kd", "", time() - 300);

header("Location: ../../index.php");
exit;
