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
    <title>Petugas Menu</title>
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
            position: relative;
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

        h4 {
            color: #333;
            margin-bottom: 20px;
        }

        b {
            color: #555;
        }

        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 17px;
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

        .button-danger {
            background-color: #f44336;
        }

        .button-danger:hover {
            background-color: #e53935;
        }

        .button-back {
            align-items: left;
            top: 20px;
            left: 20px;
            background-color: #4CAF50;
            padding: 10px 20px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: auto;
        }

        .button-back:hover {
            background-color: #45a049;
        }
        .flex-container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .flex-column {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="flex-container">

            <div class="flex-column">
                <input type="button" class="button-back" onclick="location.href='http://localhost/CS-Daily-Task-Upload/index.php';" value="Back" />
            </div>
            <div class="flex-column">
                <input type="button" class="button button-danger" onclick="location.href='http://localhost/CS-Daily-Task-Upload/includes/logout.php';" value="Logout" />
            </div>
        </div>
        
        <h4>Aktivitas Kegiatan</h4>        
        <p>Lokasi Tugas: <b> <?php echo $_SESSION['lokasi']; ?></b></p>
        <br>
        
        <input type="button" class="button button-secondary" onclick="location.href='http://localhost/CS-Daily-Task-Upload/absensi.php';" value="Absensi" />
        <br>
        <input type="button" class="button button-secondary" onclick="location.href='http://localhost/CS-Daily-Task-Upload/includes/petugasInputSebelum.php';" value="Input Sebelum Dikerjakan" />
        <br>
        <input type="button" class="button button-secondary" onclick="location.href='http://localhost/CS-Daily-Task-Upload/includes/petugasInputSesudah.php';" value="Input Sesudah Dikerjakan" />
        <br>
        <input type="button" class="button button-secondary" onclick="location.href='http://localhost/CS-Daily-Task-Upload/includes/lihatKomplain.php';" value="Lihat Komplain" />
    </div>
</body>
</html>
