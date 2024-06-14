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
        #video {
            display: none;
            margin: auto;
            width: 100%;
            max-width: 500px;
        }
        #canvas {
            display: none;
        }
        .task {
            margin-bottom: 20px;
            clear: both;
        }
        .task-header {
            margin-bottom: 10px;
        }
        .images {
            display: flex;
        }
        .images figure {
            margin-right: -10px;
        }
        .images img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>   
    <input type="button" onclick="location.href='http://localhost/CS-Daily-Task-Upload/index.php';" value="Back" />

    <h3> Form Survey/Komplain Karyawan </h3>

    <p>NIK     : <?php echo $_SESSION['nik'];?></p>
    <p>Nama    : <?php echo $_SESSION['nama'];?></p>
    <p>Jabatan : <?php echo $_SESSION['jabatan'];?></p>
    <br>
    
    <b>Lokasi Tugas     : <?php echo $_SESSION['lokasi']; ?></b> <br>
  
    <!-- <b>Nama Karyawan</b> <input type="text" name="namaKaryawan" placeholder="Nama Karyawan"> -->

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
        <!-- <p>Sudah Dikerjakan</p> -->
        <?php
        
        
        // Sebelum Image
        echo '<div class="images">';
        for ($j = 0; $j <= count($tugas)-1; $j++) {
            if (isset($tugas_images_sebelum[$j][0]) && $tugas_images_sebelum[$j][0] == $tugas[$i][0]){ 
                $flag1 = 1; ?>
                <figure>
                    <img src="<?php echo $tugas_images_sebelum[$j][1] ?>" style="width:100px;height:100px;">
                    <figcaption>Sebelum</figcaption>
                </figure>
                <?php break;
            } 
        }
        if ($flag1 == 0) { ?>
            <figure>
                <button type="button">
                    <img src="images/noImage.jpg" style="width:100px;height:100px;">
                    <figcaption>Belum Difoto</figcaption>
                </button>
            </figure>
            <?php
            echo '</div></div>';
            continue;
        } 


        // Sesudah Image
        echo '<div class="images">';
        for ($k = 0; $k <= count($tugas)-1; $k++) {
            if (isset($tugas_images_sesudah[$k][0]) && $tugas_images_sesudah[$k][0] == $tugas[$i][0]){ 
                $flag2 = 1; 
                ?>
                <figure>
                    <img src="<?php echo $tugas_images_sesudah[$k][1] ?>" style="width:100px;height:100px;">
                    <figcaption>Sesudah</figcaption>
                </figure>
                <?php break;
            } 
        }
        if ($flag2 == 0) {  ?>
            <figure>
                <button type="button">
                    <img src="images/noImage.jpg" style="width:100px;height:100px;">
                    <figcaption>Belum Difoto</figcaption>
                </button>
            </figure>
            <?php
            echo '</div></div>';
            continue;
        } 

        echo '</div></div>';

        if ($flag1 == 1 && $flag2 == 1) {
            ?>
            
            <!-- <input type="button" onclick="location.href='http://localhost/CS-Daily-Task-Upload/submitKomplain.php';" value="Submit Komplain" /> -->
            <input type="button" onclick="location.href='http://localhost/CS-Daily-Task-Upload/includes/submitKomplain.php?tugas_id=<?php echo ${"tugasId$i"} ?>';" value="Submit Komplain" />

            <?php
        }
        
        echo '<br><br>';
        
        $flag1 = 0;
        $flag2 = 0;
        ?>
        
    <?php 
    } ?>
    
    <input type="submit" value="Submit">
</html>