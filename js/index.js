/**
 * Created by Jiawei on 9/14/2015.
 */
myApp = angular.module('app', ['ngRoute']);

// configure our routes
myApp.config(function($routeProvider) {
    $routeProvider

        // route for the home page
        .when('/', {
            templateUrl : 'pages/signup.html',
            controller  : 'signupController'
        })

        // route for the about page
        .when('/home', {
            templateUrl : 'pages/home.html',
            controller  : 'homeController'
        })

        // route for the contact page
        .when('/contact', {
            templateUrl : 'pages/contact.html',
            controller  : 'contactController'
        });
});

myApp.controller('controller', function($scope) {
    $scope.logIn = function() {
        $scope.loggedIn = true;
        console.log("Logged In");
    }

    $scope.logOut = function() {
        $scope.loggedIn = false;
        console.log("Logged Out");
    }

    $scope.init = function() {
        $scope.loggedIn = false;
    }

    $scope.init();
})

myApp.controller('signupController', function ($scope) {
    console.log("signup Controller");
    $scope.signUp = function() {
        console.log("Sign Up Button pressed");
    }


})

myApp.controller('homeController', function($scope) {
    console.log("home Controller");
})