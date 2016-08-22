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