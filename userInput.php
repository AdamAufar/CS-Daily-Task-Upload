<?php 
session_start();
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Komplain</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            margin-top: 20px;
        }

        h3 {
            color: #333;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        td {
            background-color: #fff;
        }

        input[type="button"], .back-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin: 20px 0;
            display: block;
            width: fit-content;
            margin-left: auto;
            margin-right: auto;
        }

        input[type="button"]:hover, .back-button:hover {
            background-color: #45a049;
        }
        
        .images {
            display: flex;
            gap: 20px; /* Add spacing between images */
        }

        .images figure {
            flex: 1;
            max-width: 50%; /* Cap each image at half the container width */
        }

        .images img {
            width: 100%;
            height: auto;
            display: block;
        }

        figure {
            margin: 20px 0;
            text-align: left;
        }

        figure img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
        }

        figure figcaption {
            text-align: center;
            margin-top: 5px;
        }

        img {
            max-width: 100%;
            height: auto;
            width: auto\9; /* ie8 */
        }

        figcaption {
            text-align: center;
            margin-right: 25px;
        }

        .task {
            margin-bottom: 20px;
            clear: both;
        }

        .task-header {
            margin-bottom: 10px;
        }

        /* Button Styling */
        .back-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #45a049;
        }

        input[type="button"], .back-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            margin: 20px 0;
            display: block;
            width: fit-content;
            font-size: 13px; 
            margin-left: 0;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="http://localhost/CS-Daily-Task-Upload/index.php" class="back-button">Back</a>

        <h3>Form Survey/Komplain Karyawan</h3>

        <table>
            <tbody>
                <tr>
                    <td><b>NIK</b></td>
                    <td><?php 
                        if (isset($_SESSION['nik'])) 
                            echo $_SESSION['nik'];
                        else 
                            echo '-'
                    ?></td>
                </tr>
                <tr>
                    <td><b>Nama</b></td>
                    <td><?php 
                        if (isset($_SESSION['nama'])) 
                            echo $_SESSION['nama'];
                        else 
                            echo '-'
                    ?></td>
                </tr>
                <tr>
                    <td><b>Jabatan</b></td>
                    <td><?php 
                        if (isset($_SESSION['jabatan'])) 
                            echo $_SESSION['jabatan'];
                        else 
                            echo '-'
                    ?></td>
                </tr>
                <tr>
                    <td><b>Lokasi Tugas</b></td>
                    <td><?php echo $_SESSION['lokasi'];?></td>
                </tr>
            </tbody>
        </table>

        <h3>Laporan Hasil Pekerjaan</h3>
        <?php
        $tugas = $_SESSION['tugasList']; 
        $tugas_images_sebelum = $_SESSION['tugas_images_sebelum'];
        $tugas_images_sesudah = $_SESSION['tugas_images_sesudah'];
        $flag1 = 0;
        $flag2 = 0;
        for ($i = 0; $i <= count($tugas)-1; $i++) {
            ${"tugasId$i"} =  $tugas[$i][0];
            ${"tugasName$i"} = ($i+1) . ". " . $tugas[$i][1];
            echo '<div class="task">';
            echo '<div class="task-header">' . ${"tugasName$i"} . '</div>'; 
            ?>

            <div class="images">
                <?php
                // Sebelum Image
                for ($j = 0; $j <= count($tugas)-1; $j++) {
                    if (isset($tugas_images_sebelum[$j][0]) && $tugas_images_sebelum[$j][0] == $tugas[$i][0]){ 
                        $flag1 = 1; ?>
                        <figure>
                            <img src="<?php echo $tugas_images_sebelum[$j][1] ?>" alt="Sebelum">
                            <figcaption>Sebelum</figcaption>
                        </figure>
                        <?php break;
                    } 
                }
                if ($flag1 == 0) { ?>
                    <figure>
                        <img src="images/noImageSebelum.png" alt="Belum Difoto">
                        <figcaption>Belum Difoto</figcaption>
                    </figure>
                <?php 
                } 
                ?>
                
                <?php
                // Sesudah Image
                for ($k = 0; $k <= count($tugas)-1; $k++) {
                    if (isset($tugas_images_sesudah[$k][0]) && $tugas_images_sesudah[$k][0] == $tugas[$i][0]){ 
                        $flag2 = 1; 
                        ?>
                        <figure>
                            <img src="<?php echo $tugas_images_sesudah[$k][1] ?>" alt="Sesudah">
                            <figcaption>Sesudah</figcaption>
                        </figure>
                        <?php break;
                    } 
                }
                if ($flag2 == 0) { ?>
                    <figure>
                        <img src="images/noImageSesudah.png" alt="Belum Difoto">
                        <figcaption>Belum Difoto</figcaption>
                    </figure>
                <?php 
                } 
                ?>
            </div>

            <?php
            if ($flag1 == 1 && $flag2 == 1) {
                ?>
                <input type="button" onclick="location.href='http://localhost/CS-Daily-Task-Upload/includes/submitKomplain.php?tugas_id=<?php echo ${"tugasId$i"} ?>';" value="Submit Komplain" />
                <?php
            }
            
            echo '<br><br>';
            
            $flag1 = 0;
            $flag2 = 0;
            ?>
        <?php 
        } ?>
    </div>
</body>
</html>
