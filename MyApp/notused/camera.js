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
