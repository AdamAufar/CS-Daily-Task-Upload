<?php 
session_start();
if(isset($_SESSION['id'])){
    header('Location: petugasMenu.php');
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css"> -->
    <title>Petugas Login</title>
</head>

<body>
    <input type="button" onclick="location.href='http://localhost/CS-Daily-Task-Upload/index.php';" value="Back" />
    <br>
    <?php
    if (!isset($_SESSION["id"])) { ?>
    
        <img src="images/bgalogo.png" style="width:150px;height:150px;">
        <br>
        <h4>Selamat Datang Di</h4>
        <h3>Aplikasi Cleaning Service</h3>
        <h3>Login</h3>

        <form action="includes/login.php" method="post">
            <input type="text" name="username" id="username" placeholder="Username">
            <br>
            <input type="password" name="password" id="password" placeholder="Password">
            <br>
            <button>Login</button>
        </form>
    <?php } ?>
</body>

</html>