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
    $tableFlag = 0;
    $headerFlag = 0;
    $allKomplain = $_SESSION['allKomplain'];
    for ($i = 0; $i <= count($allKomplain)-1; $i++) { 
        ${"komplainId$i"} =  $allKomplain[$i][0];

        // IF not same as last one, dont print
        if ($headerFlag == 0) 
            echo '<div class="task-header">' . $allKomplain[$i][0] . ". " . $allKomplain[$i][1] . '</div>'; 

        if ($tableFlag == 0) { ?> 
            <table border="2">
                <thead>
                    <th> Nama </th>
                    <th> Catatan </th>
                    <th> Status </th>
                    <th> Foto </th>
                    <th> Follow Up </th>
                </thead>
                <tbody>
            <?php  
            $tableFlag = 1;
        }
                
        echo '<tr>';
            echo '<td>' . $allKomplain[$i][2] . '</td>';
            echo '<td>' . $allKomplain[$i][4] . '</td>';
            echo '<td>' . $allKomplain[$i][3] . '</td>';
            echo '<td>'; 
            ?> <img src="<?php echo $allKomplain[$i][5] ?>" alt="Sebelum" style="width:100px;height:100px;"> <?php
            echo '</td>';
            echo '<td>'; 
            if ($allKomplain[$i][6] == '-') { 
                $uniqueId = uniqid("task_");
                ?>
                <figure>
                    <button id="<?php echo $uniqueId; ?>_startCamera">Take Picture</button>
                    <video id="<?php echo $uniqueId; ?>_video" autoplay></video>
                    <button id="<?php echo $uniqueId; ?>_capture" style="display: none;">Capture Photo</button>
                    <canvas id="<?php echo $uniqueId; ?>_canvas" style="display: none;"></canvas>

                    <form id="<?php echo $uniqueId; ?>_photoForm" action="upload.php?komplain_id=<?php echo ${"komplainId$i"} ?>" method="post" enctype="multipart/form-data" style="display: none;">
                        <input type="hidden" name="photo" id="<?php echo $uniqueId; ?>_photo">
                        <input type="submit" value="Upload Photo">
                    </form>

                    <script>
                        (function() {
                            const startCameraButton = document.getElementById('<?php echo $uniqueId; ?>_startCamera');
                            const video = document.getElementById('<?php echo $uniqueId; ?>_video');
                            const captureButton = document.getElementById('<?php echo $uniqueId; ?>_capture');
                            const canvas = document.getElementById('<?php echo $uniqueId; ?>_canvas');
                            const photoInput = document.getElementById('<?php echo $uniqueId; ?>_photo');
                            const photoForm = document.getElementById('<?php echo $uniqueId; ?>_photoForm');

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
                        })();
                    </script>
                    <figcaption>Sebelum</figcaption>
                </figure>
                <?php 
            }  else {
                ?> <img src="<?php echo $allKomplain[$i][6] ?>" alt="Sebelum" style="width:100px;height:100px;"> <?php
            }
            echo '</td>';
        echo '</tr>';

        if (isset($allKomplain[$i+1][0]) && $allKomplain[$i][0] != $allKomplain[$i+1][0]) {
            echo "</tbody> </table> <br>";
            $tableFlag = 0;
        }

        if (isset($allKomplain[$i+1][0]) && $allKomplain[$i][0] == $allKomplain[$i+1][0])
            $headerFlag = 1;
        else 
            $headerFlag = 0;
    } ?>
</html>
