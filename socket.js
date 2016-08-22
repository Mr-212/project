    var app = require('express')();
    var server = require('http').Server(app);
    var io = require(__dirname +'/public/bower_components/socket.io')(server);
    var redis = require('node-redis');

    //io.set('transports', [
    //      'websocket'
    //    , 'flashsocket'
    //    , 'htmlfile'
    //    , 'xhr-polling'
    //    , 'jsonp-polling'
    //    , 'polling'
    //]);
    //var pub = redis.createClient();

    server.listen(3000,function(){
        console.log('listining on port 3000');
    });
            io.on('connection', function (socket) {


                    var redisClient = redis.createClient();

                    console.log("client connected");
                    redisClient.subscribe('message');

                    redisClient.on("message", function (channel, data){

                        data=data.toString();
                        //console.log(data);
                        socket.emit(channel,data);

                    });

                socket.on('join',function(data){
                    io.emit('join',data);
                });

                socket.on('leave',function(data){
                    io.emit('leave',data);
                })


                redisClient.on('error', function (error) {
                    console.log('error: '+ error);
                });

                socket.on('disconnect', function () {
                        redisClient.quit();
                });

        });







