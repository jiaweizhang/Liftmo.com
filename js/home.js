/**
 * Created by Jiawei on 9/14/2015.
 */
myApp = angular.module('homeApp', []);

/*
myApp.controller('homeController', ['$scope', function(sc) {
    // ...
}]);
*/

myApp.controller('homeController', function ($scope) {

    $scope.logIn = function() {
        $scope.loggedIn = true;
    }

    $scope.logOut = function() {
        $scope.loggedIn = false;
    }

    $scope.signUp = function() {

    }

    $scope.init = function() {
        $scope.loggedIn = false;
    }

    $scope.init();
})