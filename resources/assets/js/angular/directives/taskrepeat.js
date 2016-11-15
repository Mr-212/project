
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