<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>    
    <img src="images/bgalogo.png" style="width:150px;height:150px;">
    <br>
    <h4>Selamat Datang Di</h4>
    <h3>Aplikasi Cleaning Service</h3>

    <?php 
    if (!isset($_SESSION['lokasi']) || isset($_GET["lokasi"])) {
        $_SESSION['lokasi'] = $_GET["lokasi"]; 
    }
    echo "Lokasi Tugas: " . $_SESSION["lokasi"];?>
    <br>   
    <input type="button" onclick="location.href='http://localhost/MyApp/login.php';" value="Saya Petugas" />
    <br>
    <input type="button" onclick="location.href='http://localhost/MyApp/includes/userInput.php';" value="Saya Karyawan" />

</body>
</html>