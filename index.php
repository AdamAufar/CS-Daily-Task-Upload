<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Aplikasi Cleaning Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            max-width: 600px;
        }

        h3, h4 {
            color: #333;
            margin: 10px 0;
        }

        b {
            color: #555;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px 0;
            width: 100%;
        }

        .button:hover {
            background-color: #45a049;
        }

        .button-secondary {
            background-color: #008CBA;
        }

        .button-secondary:hover {
            background-color: #007BB5;
        }

        img {
            width: 150px;
            height: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="images/bgalogo.png" alt="Logo">
        <h4>Selamat Datang Di</h4>
        <h3>Aplikasi Cleaning Service</h3>

        <?php 
        if (!isset($_SESSION['lokasi']) || isset($_GET["lokasi"])) {
            $_SESSION['lokasi'] = $_GET["lokasi"]; 
        }
        echo "<p>Lokasi Tugas: <b>" . $_SESSION["lokasi"] . "</b></p>";
        ?>

        <input type="button" class="button" onclick="location.href='login.php';" value="Saya Petugas" />
        <input type="button" class="button button-secondary" onclick="location.href='includes/userInput.php';" value="Saya Karyawan" />
    </div>
</body>
</html>
