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
    <!-- <link rel="stylesheet" type="text/css" href="popupMessage.css"> -->
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
    </style>
</head>
 
<body>
    <input type="button" onclick="location.href='http://localhost/CS-Daily-Task-Upload/petugasMenu.php';" value="Back" />

    <h3> Absensi </h3>
    
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

    <br>

    <h3>Foto Absen</h3>

    <br>
    <?php 
    if (!isset($_SESSION['absensi_image'])) {  ?>
        <button id="startCamera">Take Picture</button>
        <video id="video" autoplay></video>
        <button id="capture" style="display: none;">Capture Photo</button>
        <canvas id="canvas" style="display: none;"></canvas>

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
                // Access the device camera and stream to video element
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(s => {
                        stream = s;
                        video.srcObject = stream;
                        video.style.display = 'block';
                        captureButton.style.display = 'block';
                        video.play(); // Ensure the video is playing
                    })
                    .catch(err => {
                        console.error("Error accessing camera: " + err);
                    });
            });

            captureButton.addEventListener('click', () => {
                // Ensure the video stream is playing
                if (video.readyState === video.HAVE_ENOUGH_DATA) {
                    const context = canvas.getContext('2d');
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);

                    // Convert the image to a data URL and set it as the value of the hidden input field
                    const dataUrl = canvas.toDataURL('image/png');
                    photoInput.value = dataUrl;

                    // Stop the video stream
                    stream.getTracks().forEach(track => track.stop());
                    video.srcObject = null;
                    video.style.display = 'none';
                    captureButton.style.display = 'none';

                    // Show the photo form and submit it
                    photoForm.style.display = 'block';
                    photoForm.submit();
                } else {
                    console.error("Video is not ready for capturing.");
                }
            });

            // Clean up stream on page unload
            window.addEventListener('beforeunload', () => {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
            });
        });
        </script>
        <?php 
        // include 'popupMessage.php';
    } else {    
        $absensi_image = $_SESSION['absensi_image']['filename'];
        $absen_at = $_SESSION['absensi_image']['absen_at'];
        ?>
        <br>
        <figure>
            <img src="<?php echo $absensi_image ?>" style="width:100px;height:100px;">
            <figcaption> Absen at: <?php echo date('H:i', strtotime($absen_at)) ?> </figcaption>
        </figure>
        <br>
        <?php
    } ?>

    <br>
    <br>


    <table border="2">
        <thead>
            <th>
                Tanggal
            </th>
            <th>
                Jam Absen
            </th>
        </thead>
        <tbody>
            <?php 
            
            
            $j = 0;
            $begin = new DateTime($startDate);
            $end = new DateTime($currentDate);
            $all_absen = $_SESSION['all_absen'];
            for($i = $begin; $i <= $end; $i->modify('+1 day')){
                echo '<tr>';
                echo '<td>' . $i->format("Y-m-d") . '</td>';

                // echo $i->format("Y-m-d") . '   ';
                // echo  $all_absen[$j][1] .  '<br>';

                if (date('w', strtotime($i->format("Y-m-d"))) == '6' || date('w', strtotime($i->format("Y-m-d"))) == '0') {
                    echo '<td> LIBUR </td>';
                    if (isset($all_absen[$j][1]) && $i->format("Y-m-d") == $all_absen[$j][1]) {
                        $j++;
                    }
                } else if (isset($all_absen[$j][1]) && $i->format("Y-m-d") == $all_absen[$j][1]) {
                    if ($all_absen[$j][2] > '08:00:00') {
                        echo '<td> <span style="color: red;"> ' . $all_absen[$j][2] . '</span></td>';
                    } else {
                        echo '<td>' . $all_absen[$j][2] . '</td>';
                    }
                    $j++;
                } else {
                    echo '<td> - </td>';
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>


</body>
</html>
