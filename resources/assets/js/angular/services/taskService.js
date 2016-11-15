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
