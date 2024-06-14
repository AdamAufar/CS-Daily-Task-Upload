<button id="startCamera">Take Picture</button>
<video id="video" autoplay></video>
<button id="capture" style="display: none;">Capture Photo</button>
<canvas id="canvas" style="display: none;"></canvas>

<form id="photoForm" action="upload.php" method="post" enctype="multipart/form-data" style="display: none;">
    <input type="hidden" name="photo" id="photo">
    <input type="submit" value="Upload Photo">
</form>
