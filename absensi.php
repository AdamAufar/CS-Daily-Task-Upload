<?php
require_once 'includes/absensi.php';
?>

<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petugas Absensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
            margin-top: 20px;
        }

        h3 {
            color: #333;
            text-align: center;
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

        td span {
            font-weight: bold;
        }

        input[type="button"], button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin: 20px 0;
            border-radius: 4px;
        }

        input[type="button"]:hover, button:hover {
            background-color: #45a049;
        }

        #video {
            display: none;
            margin: auto;
            width: 100%;
            max-width: 500px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        #canvas {
            display: none;
        }

        figure {
            margin: 20px 0;
            text-align: center;
        }

        figure img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            width: 200px;
            height: 150px;
        }

        form {
            text-align: center;
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
            font-size: 13px;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="http://localhost/CS-Daily-Task-Upload/petugasMenu.php" class="back-button">Back</a>

        <h3>Absensi</h3>

        <table>
            <tbody>
                <tr>
                    <td><b>NIK</b></td>
                    <td><?php echo $_SESSION['nik']; ?></td>
                </tr>
                <tr>
                    <td><b>Nama</b></td>
                    <td><?php echo $_SESSION['nama']; ?></td>
                </tr>
                <tr>
                    <td><b>Jabatan</b></td>
                    <td><?php echo $_SESSION['jabatan']; ?></td>
                </tr>
                <tr>
                    <td><b>Lokasi Tugas</b></td>
                    <td><?php echo $_SESSION['lokasi']; ?></td>
                </tr>
            </tbody>
        </table>

        <h3>Foto Absen</h3>

        <?php 
        if (!isset($_SESSION['absensi_image'])) {  ?>
            <div style="text-align: center;">
                <button id="startCamera">Take Picture</button>
                <video id="video" autoplay></video>
                <button id="capture" style="display: none;">Capture Photo</button>
                <canvas id="canvas" style="display: none;"></canvas>
            </div>

            <form id="photoForm" action="upload.php" method="post" enctype="multipart/form-data" style="display: none;">
                <input type="hidden" name="photo" id="photo">
                <input type="submit" value="Upload Photo">
            </form>

            <script>
                document.addEventListener('DOMContentLoaded', (event) => {
                    const startCameraButton = document.getElementById('startCamera');
                    const video = document.getElementById('video');
                    const captureButton = document.getElementById('capture');
                    const canvas = document.getElementById('canvas');
                    const photoInput = document.getElementById('photo');
                    const photoForm = document.getElementById('photoForm');

                    let stream;

                    startCameraButton.addEventListener('click', () => {
                        navigator.mediaDevices.getUserMedia({ video: true })
                            .then(s => {
                                stream = s;
                                video.srcObject = stream;
                                video.style.display = 'block';
                                captureButton.style.display = 'block';
                                video.play();
                            })
                            .catch(err => {
                                console.error("Error accessing camera: " + err);
                            });
                    });

                    captureButton.addEventListener('click', () => {
                        if (video.readyState === video.HAVE_ENOUGH_DATA) {
                            const context = canvas.getContext('2d');
                            canvas.width = video.videoWidth;
                            canvas.height = video.videoHeight;
                            context.drawImage(video, 0, 0, canvas.width, canvas.height);

                            const dataUrl = canvas.toDataURL('image/png');
                            photoInput.value = dataUrl;

                            stream.getTracks().forEach(track => track.stop());
                            video.srcObject = null;
                            video.style.display = 'none';
                            captureButton.style.display = 'none';

                            photoForm.style.display = 'block';
                            photoForm.submit();
                        } else {
                            console.error("Video is not ready for capturing.");
                        }
                    });

                    window.addEventListener('beforeunload', () => {
                        if (stream) {
                            stream.getTracks().forEach(track => track.stop());
                        }
                    });
                });
            </script>
        <?php 
        } else {    
            $absensi_image = $_SESSION['absensi_image']['filename'];
            $absen_at = $_SESSION['absensi_image']['absen_at'];
            ?>
            <figure>
                <img src="<?php echo $absensi_image ?>" style="width:400px;height:300px;">
                <figcaption>Absen at: <?php echo date('H:i', strtotime($absen_at)) ?></figcaption>
            </figure>
        <?php
        } ?>

        <table>
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Jam Absen</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $j = 0;
                $begin = new DateTime($startDate);
                $end = new DateTime($currentDate);
                $all_absen = $_SESSION['all_absen'];
                for ($i = $begin; $i <= $end; $i->modify('+1 day')) {
                    echo '<tr>';
                    echo '<td>';
                        switch (date('w', strtotime($i->format("Y-m-d")))) {
                            case "0":
                            echo "Minggu";
                            break;
                            case "1":
                            echo "Senin";
                            break;
                            case "2":
                            echo "Selasa";
                            break;
                            case "3":
                            echo "Rabu";
                            break;
                            case "4":
                            echo "Kamis";
                            break;
                            case "5":
                            echo "Jumat";
                            break;
                            case "6":
                            echo "Sabtu";
                            break;
                        }
                    echo '</td>';
                    echo '<td>' . $i->format("d-m-Y") . '</td>';

                    if (date('w', strtotime($i->format("Y-m-d"))) == '6' || date('w', strtotime($i->format("Y-m-d"))) == '0') {
                        echo '<td>LIBUR</td>';
                        if (isset($all_absen[$j][1]) && $i->format("Y-m-d") == $all_absen[$j][1]) {
                            $j++;
                        }
                    } else if (isset($all_absen[$j][1]) && $i->format("Y-m-d") == $all_absen[$j][1]) {
                        if ($all_absen[$j][2] > '08:00:00') {
                            echo '<td><span style="color: red;">' . $all_absen[$j][2] . '</span></td>';
                        } else {
                            echo '<td>' . $all_absen[$j][2] . '</td>';
                        }
                        $j++;
                    } else {
                        echo '<td>-</td>';
                    }
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
