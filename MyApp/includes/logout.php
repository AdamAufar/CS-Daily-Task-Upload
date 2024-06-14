<?php 
session_start();
$lokasi = $_SESSION['lokasi'];
session_unset();
session_destroy();
header("Location: ../index.php?lokasi=$lokasi");
exit;
?>