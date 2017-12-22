var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var redis = require('redis');

io.on('connection', function(socket){
    console.log('new client connected');
    socket.emit('info', socket.id);

    var client = redis.createClient();
    client.subscribe('chat.2');
    client.on("message", function(channel, message) {
        msg = JSON.parse(message);
        //if(msg.socketid==socket.id){
            console.log("mew message in channel "+ channel);
            console.log("mew message in queue "+ message);
            socket.emit('message', msg.content);
        //}
    });

    socket.on('disconnect', function(){
        console.log('client disconnected');
        client.quit();
    });
});
  
http.listen(6001, function(){
    console.log('listening on *:6001');
});
