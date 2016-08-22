

var app = angular.module('chat',['ngRoute','luegg.directives']);

    app.config(['$routeProvider', function($routeProvider) {
        try {
            $routeProvider.when('/chat', {
                templateUrl: '/partials/chat.blade.php',
                controller: 'chatcontroller',
            }).
                otherwise({
                    redirectTo: '/'
                });
        }catch(e){
            console.log('catch: ' +e);
        }
        //$routeProvider.interceptors.push(function($q) {
        //    return {
        //        responseError: function(rejection) {
        //            if(rejection.status <= 0) {
        //                window.location = "chat.blade.php";
        //                return;
        //            }
        //            return $q.reject(rejection);
        //        }
        //    };
        //});
    }
    ]);

    app.factory('message',function($http) {

        return {
            msg : function (value) {
                $http.post('/chat/sendmessage', value).success(function (data) {
                    console.log(data);
                    //socket.emit('join', data);
                })
            }
        }

    });



    app.factory('socket',function($rootScope){

        var socket = io.connect("http://www.pm.local:3000/");


        return {
            on: function (eventName, callback) {
                socket.on(eventName, function () {
                    var args = arguments;
                    $rootScope.$apply(function () {
                        callback.apply(socket, args);
                    });
                });

            },


            emit: function (eventName, data, callback) {
                socket.emit(eventName, data, function () {
                    var args = arguments;
                    $rootScope.$apply(function () {
                        if (callback) {
                            callback.apply(socket, args);
                        }
                    });
                });
            }
        }


});


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

/**
 * Created by cube7r on 8/18/2016.
 */

    angular.module('chat').directive('scrollBottom',function($timeout){

        //qvar j= $.noConflict();
            return{
                scope:{
                    list:'=scrollBottom'
                },
                link:function($scope, $element){
                    $scope.$watchCollection('list',function(newValue){

                        if(newValue){
                            $timeout(function(){
                                $element.scrollTop($element[0].scrollHeight);
                            }, 0);

                        }

                    });

                }

            }
        });
//# sourceMappingURL=chat.js.map
