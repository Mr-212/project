
    var app=angular.module('chat');
    app.controller('chatcontroller', function($scope,socket ,message,$http,$timeout, $location,$anchorScroll){

        var j=angular.element;


        $scope.users=[];
        $scope.data=[];
        //$scope.input='';
        //$scope.glued = true;

        //--join char--//
        $scope.joinChat = function(){
            $('.chat, .chat1').slideDown();
            //$('.chat1').slideDown();
            $('.join').hide();
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
            $('.chat, .join').slideUp();
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




      //<--!$uery-->
        //$('.chat').hide();
        $('#showchat').on('click',function(){
            $('.join').slideDown();
        });
        //j('.window').unbind('click');
        j('.window').off().on('click',function(){
            //e.stopImmediatePropagation()    //-- another solution for dubble slide
            j('.chat1').slideToggle();

        });



    });
