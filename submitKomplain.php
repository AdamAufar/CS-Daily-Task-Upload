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
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            margin-bottom: 10px;
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

        .task {
            margin-bottom: 20px;
        }
        .task-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .images {
            display: flex;
            justify-content: left; /* Center the items horizontally */
            align-items: center; /* Center items vertically if necessary */
            margin-bottom: 20px; /* Added margin-bottom for spacing */
        }

        .images figure {
            margin: 0 10px; /* Adjusted to add space around figures */
            text-align: center; /* Center the content inside figures */
        }

        .images img {
            width: 200px;
            height: 150px;
            display: block;
            object-fit: cover;
        }


        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form input[type="text"],
        form input[type="radio"],
        form label {
            vertical-align: middle; /* Align radio button with text */
        }

        form input[type="radio"] {
            margin-right: 5px; /* Space between radio button and label */
        }


        form button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        form button:hover {
            background-color: #0056b3;
        }
        #video {
            display: none;
            width: 100%;
            max-width: 500px;
            margin: 10px auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        #canvas {
            display: none;
        }
        

        figure img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
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
        <a href="http://localhost/CS-Daily-Task-Upload/includes/userinput.php" class="back-button">Back</a>
    
        <h3> Form Survey/Komplain Karyawan </h3>

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
        echo '<div class="task">';
        echo '<div class="task-header">' . $_SESSION['nama_tugas'][0] . '. ' . $_SESSION['nama_tugas'][1] . '</div>'; 
        $tugas_id = $_SESSION['nama_tugas'][0];
        ?>

        <div class="images">
            <figure>
                <img src="<?php echo $_SESSION['tugas_images_sebelum'][0] ?>" alt="Sebelum" title="Sebelum">
                <figcaption>Sebelum</figcaption>
            </figure>

            <figure>
                <img src="<?php echo $_SESSION['tugas_images_sesudah'][0] ?>" alt="Sesudah" title="Sesudah">
                <figcaption>Sesudah</figcaption>
            </figure>
        </div>

        <p>Inspeksi Hasil Pekerjaan</p>

        <form id="complainForm" action="upload.php?" method="post">
            <b>Nama Karyawan</b> <input type="text" name="namaKaryawan" id="namaKaryawan" placeholder="Nama Karyawan">
            <br><br>
            <input type="radio" id="bersih0" name="status" value="0">
            <label for="bersih">Bersih</label>
            <input type="radio" id="kurangBersih" name="status" value="1">
            <label for="kurangBersih">Kurang Bersih</label> 
            <input type="radio" id="kotor" name="status" value="2">
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const startCameraButton = document.getElementById('startCamera');
            const video = document.getElementById('video');
            const captureButton = document.getElementById('capture');
            const canvas = document.getElementById('canvas');
            const photoInput = document.getElementById('photo');
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

