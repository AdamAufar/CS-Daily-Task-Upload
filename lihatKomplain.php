<?php 
session_start();
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Komplain</title>
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
    <input type="button" onclick="location.href='http://localhost/CS-Daily-Task-Upload/petugasMenu.php';" value="Back" />

    <h3>Form Input Pekerjaan Harian</h3>

    <table border="1">
        <tbody>
            <tr>
                <td>
                    <b> NIK </b>
                </td>
                <td>
                    <?php echo $_SESSION['nik'];?>
                </td>
            </tr>
            <tr>
                <td>
                    <b> Nama </b>
                </td>
                <td>
                    <?php echo $_SESSION['nama'];?>
                </td>
            </tr>
            <tr>
                <td>
                    <b> Jabatan </b>
                </td>
                <td>
                    <?php echo $_SESSION['jabatan'];?>
                </td>
            </tr>
            <tr>
                <td>
                    <b> Lokasi Tugas </b>
                </td>
                <td>
                    <?php echo $_SESSION['lokasi'];?>
                </td>
            </tr>
        </tbody>
    </table>

    <h3>List Komplain</h3>
    <?php
    $flag1 = 0;
    $allKomplain = $_SESSION['allKomplain'];
    for ($i = 0; $i <= count($allKomplain)-1; $i++) { 
        ${"tugasId$i"} =  $allKomplain[$i][0];
        echo '<div class="task">';

        // IF not same as last one, dont print
        if ($flag1 == 0) 
            echo '<div class="task-header">' . $allKomplain[$i][0] . ". " . $allKomplain[$i][1] . '</div>'; 

        if (isset($allKomplain[$i+1][0]) && $allKomplain[$i][0] == $allKomplain[$i+1][0])
            $flag1 = 1;
        else 
            $flag1 = 0;
        // k.tugas_id, th.details, k.nama, k.status, k.catatan, k.filename 
        echo "<a>" . $allKomplain[$i][2] . ' | ' . $allKomplain[$i][4] . ' | ' . $allKomplain[$i][3] . "</as>";
        

        echo '<div class="images">'; ?>
        <figure>
            <img src="<?php echo $allKomplain[$i][5] ?>" alt="Sebelum">
            <figcaption>Komplain: <?php echo $allKomplain[$i][6] ?></figcaption>
        </figure> <?php

        echo '</div></div>';
    } ?>
</html>
