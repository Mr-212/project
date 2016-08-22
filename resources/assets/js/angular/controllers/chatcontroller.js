

    var app=angular.module('chat');
    app.controller('chatcontroller', function($scope,socket ,message,$http,$timeout, $location,$anchorScroll){
        var jq = $.noConflict();
        $scope.users=[];
        $scope.data=[];
        //$scope.input='';
        //$scope.glued = true;



        //--join char--//
        $scope.joinChat = function(){
            jq('.chat, .chat1').slideDown();
            //jq('.chat1').slideDown();
            jq('.join').hide();
                  $http.get('/chat/join').success(function(data){
                       // console.log(data);
                        socket.emit('join',data);
                  })
        };

        socket.on('join',function(data){
            $scope.users.push(data);
            $scope.data.push( {
                joined : data.name+' has joined',
            });
            console.log($scope.data);
        });

        //leave chat--//
        $scope.leaveChat = function(user){
            jq('.chat, .join').slideUp();
            //jq().slideUp();
            console.log(user)
            socket.emit('leave',user+' has left');


        };
        socket.on('leave',function(name){
            console.log(name);
            $scope.data.push({joined:name});
            $scope.users.splice(name,1);
            socket.emit('disconnect');
        })

        socket.on('message',function(data){
           // $scope.$watch(function() { $timeout(scrollIfGlued, 100, false); });
            console.log(JSON.parse(data));
            data=JSON.parse(data);
            $scope.data.push(data);

        })

        //--send message==//
        $scope.sendMessage=function(){
            var value=$scope.input;
            var data= message.msg({value:value});
            $scope.input="";

            console.log(data);
        }
        socket.on('chat',function(data){
            console.log(data);
        })




      //<--!jquery-->
        //jq('.chat').hide();
        jq('#showchat').on('click',function(){
            jq('.join').slideDown();
        })
        jq('.window').on('click',function(){
            jq('.chat1').slideToggle();
        })


    });
