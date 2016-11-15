

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

/**
 * Created by cube7r on 8/31/2016.
 */

angular.module('chat').controller('taskcontroller',function($scope,taskService,$interval,$timeout,$element, NgTableParams){
    $scope.tasks=[];
    $scope.data=[];

    angular.element(document).ready(function () {

        $('#modal').on('hidden.bs.modal', function () {
            $(this).removeData('bs.modal');
        });

        //console.log($element.find('.name').css('color','red'));

        //taskService.getAll().then(function (res) {
        //    $scope.data=[];
        //    $scope.data=res.data ;
        //})




    });

    var p=$interval(function () {
        taskService.getAll().then(function (res) {
            // $scope.data = [];
            $scope.data = res.data;
            // $scope.$digest();
        })
    }, 1000);

    var self = this;
    self.tableParams= new NgTableParams({
        page: 1,            // show first page
        count: 10 },
        { dataset: $scope.tasks,

        });

    $scope.$watch('data',function(newvalue) {
        if (newvalue) {
            //$interval.cancel(p);
            //p;
            $scope.tasks = newvalue;
            $interval(function () {

                $element.find('.status').each(function (st) {
                    //console.log(el1);
                    //console.log(el2);
                    var color=$(this);
                    var status = $(this).text(), status1 = $(this).attr('value');
                    if(status=='Expired' )
                        color.css({'background-color': 'yellow'});

                    if(status=='Closed') {
                        color.css({'background-color': 'blue'});
                    }

                    $element.find('.closetask').each(function (cl) {
                    //console.log($(this).href)`
                        var close=$(this);


                     if($(this).attr('value')=='Open'){
                        close.show();
                    }



                    });
                });
            })
        }

    })









});



/**
 * Created by cube7r on 8/18/2016.
 */

    angular.module('chat').directive('scrollBottom',function($timeout){

        //qvar j= $.noConflict();
            return{
                controller:'chatcontroller',

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

angular.module('chat').directive('taskrepeat',function($timeout){

  return{
      controller:'taskcontroller',
      //link: link,
      replace: true,
      restrict: "E",
      //scope: {
      //    list: "="
      //},

      link:function(scope,element,attr){
          if(element.length>0){
              console.log(element.length)
          }


  },





  }






});
/**
 * Created by cube7r on 8/31/2016.
 */
angular.module('chat').factory('taskService',function($http,$q){

       return {
          getAll :function () {
              defer=$q.defer();

              return $http.get('/task')
                   .success(function (response) {
                       //console.log(response);
                       //return response;
                       defer.resolve();
                   }).error(function (error) {
                       return error;
                       defer.reject(error);
                   })
               return defer.promise;
       }
}


});

//# sourceMappingURL=chat.js.map
