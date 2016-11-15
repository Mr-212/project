

var app = angular.module('chat',['ngRoute','luegg.directives','countdownTimer','datatables',"ngTable"]);

    app.config(['$routeProvider', function($routeProvider) {
        //$routeProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
        try {
            $routeProvider.when('/chat', {
                templateUrl: '/partials/chat.blade.php',
                controller: 'chatcontroller',
            }).when('/task', {
                templateUrl: '/task/index.blade.php',
                controller: 'taskcontroller',
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