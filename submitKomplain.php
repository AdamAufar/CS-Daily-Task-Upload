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
    <input type="button" onclick="location.href='http://localhost/CS-Daily-Task-Upload/includes/userInput.php';" value="Back" />

    <h3> Form Survey/Komplain Karyawan </h3>

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

    <h3>Laporan Hasil Pekerjaan</h3>
    <?php
    echo '<div class="task">';
    echo '<div class="task-header">' . $_SESSION['nama_tugas'][0] . '. ' . $_SESSION['nama_tugas'][1] . '</div>'; 
    $tugas_id = $_SESSION['nama_tugas'][0];
    ?>

    <div class="images">
    <figure>
        <img src="<?php echo $_SESSION['tugas_images_sebelum'][0] ?>" style="width:100px;height:100px;">
        <figcaption>Sebelum</figcaption>
    </figure>

    <div class="images">
    <figure>
        <img src="<?php echo $_SESSION['tugas_images_sesudah'][0] ?>" style="width:100px;height:100px;">
        <figcaption>Sesudah</figcaption>
    </figure>
    </div></div>

    <p>Inspeksi Hasil Pekerjaan</p>

    <form id="complainForm" action="upload.php?" method="post">
        <b>Nama Karyawan</b> <input type="text" name="namaKaryawan" id="namaKaryawan" placeholder="Nama Karyawan">
        <br><br>
        <input type="radio" id="bersih0" name="status" value=0>
        <label for="bersih">Bersih</label> 
        <input type="radio" id="kurangBersih" name="status" value=1>
        <label for="kurangBersih">Kurang Bersih</label> 
        <input type="radio" id="kotor" name="status" value=2>
        <label for="kotor">Kotor</label>
        <br><br>
        <b>Catatan</b> <input type="text" name="catatan" id="catatan" placeholder="Komplain">
        <br><br>
        <button id="startCamera" type="button">Take Picture</button>
        <video id="video" autoplay></video>
        <button id="capture" type="button" style="display: none;">Capture Photo</button>
        <canvas id="canvas" style="display: none;"></canvas>

        <input type="hidden" name="photo" id="photo">
        <input type="hidden" name="tugas_id_k" value="<?php echo $tugas_id; ?>">
        <input type="submit" value="Submit" style="display: none;" id="submitForm">
    </form>


    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
        const startCameraButton = document.getElementById('startCamera');
        const video = document.getElementById('video');
        const captureButton = document.getElementById('capture');
        const canvas = document.getElementById('canvas');
        const photoInput = document.getElementById('photo');
        const photoForm = document.getElementById('complainForm');
        const submitFormButton = document.getElementById('submitForm');

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

                // Set the values from the form into the hidden inputs
                const namaKaryawan = document.getElementById('namaKaryawan').value;
                const status = document.querySelector('input[name="status"]:checked').value;
                const catatan = document.getElementById('catatan').value;

                // Submit the form
                submitFormButton.click();
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

</body>
</html>
