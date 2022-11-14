#!/usr/bin/env nodejs

// var app   = require('express')();
// var https  = require('https').Server(app);
// var io    = require('socket.io')(https);

var { Server } = require('socket.io')
var { createServer } = require('http')
var Redis = require('ioredis');
var redis = new Redis();


const httpServer = createServer();
const io = new Server(httpServer, {
    cors: {
        origin: "https://sniddl.test",
        methods: ["GET", "POST"],
        allowedHeaders: ["my-custom-header"],
    }
})



redis.psubscribe('*', function(err, count) {});

redis.on('pmessage', function(subscribed, channel, message) {
    message = JSON.parse(message);
    console.log(channel + ':' + message.event, message.data);
    io.emit(channel + ':' + message.event, message.data);
});

io.on('connection', function () {
    console.log('user connected');
})

httpServer.listen(3000,function(){
  console.log("listening to port 3000");
});
