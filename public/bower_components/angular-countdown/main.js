/*global angular */
(function (angular) {
    'use strict';
    angular.module('mainApp', ['countdownTimer'])
        .controller('bodyController', function ($scope) {
            $scope.dates = [
                'October 27, 2015',
                'December 25, 2015',
                'February 22, 2016'
            ];
            $scope.units = [
                'Weeks',
                'Days',
                'Hours',
                'Minutes',
                'Seconds',
                'Weeks | Days',
                'Days | Hours | Minutes | Seconds | Milliseconds'
            ];
            
        });
        
}(angular));