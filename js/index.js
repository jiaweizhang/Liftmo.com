/**
 * Created by Jiawei on 9/14/2015.
 */
myApp = angular.module('app', ['ngRoute', 'ngCookies']);

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

myApp.controller('controller', function($scope, $cookies) {
    $scope.logIn = function() {
        $scope.loggedIn = true;
        console.log("Logged In");
    }

    $scope.logOut = function() {
        $scope.loggedIn = false;
        console.log("Logged Out");
    }

    $scope.isLoggedIn = function() {
        var now = new Date(), exp = new Date(now.getFullYear(), now.getMonth()+1, now.getDate());
        $cookies.put("AuthKey0000", "abcd", {expires: exp});
        var authKey = $cookies.get("AuthKey0000");
        console.log(authKey);
        return true;
    }

    $scope.keyValid = function(authKey) {

    }

    $scope.init = function() {
        $scope.loggedIn = $scope.isLoggedIn();
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