<!DOCTYPE html>
<html>
<head>
    <title>Live Streaming</title>
    <script src="https://www.youtube.com/iframe_api"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .chat-box {
            height: 200px;
            overflow-y: scroll;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Live Streaming</h1>
        <div class="form-group mt-3">
            <input type="text" id="streamUrl" class="form-control" placeholder="Masukkan URL Live Streaming YouTube">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" onclick="startStreaming()">Mulai Streaming</button>
        </div>
        <div id="player" class="embed-responsive embed-responsive-16by9"></div>
        <div class="form-group mt-3">
            <input type="text" id="chatInput" class="form-control" placeholder="Ketik pesan...">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" onclick="sendChatMessage()">Kirim</button>
        </div>
        <div id="chat" class="chat-box"></div>
    </div>
    <script>
        // Variable untuk pemutar YouTube
        var player;

        // Fungsi untuk mengekstrak ID video dari URL YouTube
        function extractVideoId(url) {
            var videoId = '';
            if (url.indexOf('v=') !== -1) {
                videoId = url.split('v=')[1];
            } else if (url.indexOf('youtu.be/') !== -1) {
                videoId = url.split('youtu.be/')[1];
            }
            return videoId;
        }

        function startStreaming() {
            var streamUrl = document.getElementById('streamUrl').value;
            var videoId = extractVideoId(streamUrl);

            if (videoId) {
                player = new YT.Player('player', {
                    height: '360',
                    width: '640',
                    videoId: videoId,
                });
            }
        }

        // Inisialisasi WebSocket
        var chatSocket = new WebSocket('ws://localhost:8080');

        chatSocket.onmessage = function (event) {
            // Menampilkan pesan chat
            var chatDiv = document.getElementById('chat');
            chatDiv.innerHTML += event.data + '<br>';
            chatDiv.scrollTop = chatDiv.scrollHeight; // Auto scroll ke bawah
        };

        function sendChatMessage() {
            var message = 'Admin: ' + document.getElementById('chatInput').value;
            chatSocket.send(message);
            document.getElementById('chatInput').value = ''; // Bersihkan input chat
        }
    </script>
</body>
</html>
