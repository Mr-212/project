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
