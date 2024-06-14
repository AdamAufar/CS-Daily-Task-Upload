<?php 
session_start();
if(!isset($_SESSION['id'])){
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>    
    <input type="button" onclick="location.href='http://localhost/MyApp/index.php';" value="Back" />
    <input type="button" onclick="location.href='http://localhost/MyApp/includes/logout.php';" value="Logout" />
    
    <h4>Aktivitas Kegiatan</h4>
    <b>Lokasi Tugas     : <?php echo $_SESSION['lokasi']; ?></b>
    <br>
    
    <input type="button" onclick="location.href='http://localhost/MyApp/absensi.php';" value="Absensi" />
    <br>
    <input type="button" onclick="location.href='http://localhost/MyApp/includes/petugasInputSebelum.php';" value="Input Sebelum Dikerjakan" />
    <br>
    <input type="button" onclick="location.href='http://localhost/MyApp/includes/petugasInputSesudah.php';" value="Input Sesudah Dikerjakan" />
    <br>
    <input type="button" onclick="location.href='http://localhost/MyApp/includes/lihatKomplain.php';" value="Lihat Komplain" />

</body>
</html>
