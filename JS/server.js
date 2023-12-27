const WebSocketServer = require('websocket').server;
const http = require('http');

const server = http.createServer(function(request, response) {
    // Handle your HTTP requests here
});
server.listen(8080, function() {
    console.log("WebSocket server is listening on port 8080");
});

const wsServer = new WebSocketServer({
    httpServer: server
});

wsServer.on('request', function(request) {
    const connection = request.accept(null, request.origin);
    // Handle WebSocket connections and messages here
});
