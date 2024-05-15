<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RecordRTC Example</title>
    <script src="https://cdn.webrtc-experiment.com/RecordRTC.js"></script>
</head>
<body>
    <h1>RecordRTC Example</h1>
    <button onclick="startRecording()">Start Recording</button>
    <button onclick="stopRecording()">Stop Recording</button>
    <video id="recorded-video" controls autoplay></video>

    <script>
        let recorder;

        function startRecording() {
            navigator.mediaDevices.getUserMedia({ video: true, audio: true })
                .then(stream => {
                    recorder = RecordRTC(stream, {
                        type: 'video'
                    });
                    recorder.startRecording();
                })
                .catch(err => console.error('Error accessing media devices: ', err));
        }

        function stopRecording() {
            recorder.stopRecording(() => {
                let blob = recorder.getBlob();
                let video = document.getElementById('recorded-video');
                video.src = URL.createObjectURL(blob);
                // Send blob to server using AJAX or fetch API
                // Example: sendBlobToServer(blob);
            });
        }
    </script>
</body>
</html>
