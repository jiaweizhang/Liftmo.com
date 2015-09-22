/**
 * Created by Jiawei on 9/14/2015.
 */
myApp = angular.module('app', ['ngRoute', 'ngCookies']);

// configure our routes
myApp.config(function ($routeProvider) {
    $routeProvider

        // route for the home page
        .when('/', {
            templateUrl: 'pages/signup.html',
            controller: 'signupController'
        })

        // route for the about page
        .when('/home', {
            templateUrl: 'pages/home.html',
            controller: 'homeController'
        })

        // route for the contact page
        .when('/contact', {
            templateUrl: 'pages/contact.html',
            controller: 'contactController'
        });
});

myApp.controller('controller', function ($scope, $cookies, $http, $httpParamSerializerJQLike, $location) {
    console.log($location.url());
    $scope.logIn = function () {
        $scope.loggedIn = true;
        console.log("Logged In");
    }

    $scope.logOut = function () {
        $scope.loggedIn = false;
        console.log("Logged Out");
    }

    $scope.isLoggedIn = function () {
        var tempCookie = "eb12a0f89a3787c61af080ab2e7d1951";
        var now = new Date(), exp = new Date(now.getFullYear(), now.getMonth() + 1, now.getDate());
        $cookies.put("AuthKey0000", tempCookie, {expires: exp});
        var authKey = $cookies.get("AuthKey0000");
        console.log(authKey);
        $scope.keyValid(authKey);
        return true;
    }

    $scope.keyValid = function (authKey) {
        $http.get("http://liftmo.com/api/check").success(function(response) {
            console.log(response);
        })
        /*$http.post({
            url: 'http://liftmo.com/api/check',
            headers: {
                'Authorization': authKey
            }
        }).then(function (response) {
            console.log(response.headers);
            console.log(response.statusText);
        }), function(response) {
            console.log("error");
        };*/
    }

    $scope.init = function () {
        $scope.loggedIn = $scope.isLoggedIn();
    }

    $scope.init();
})

myApp.controller('signupController', function ($scope) {
    console.log("signup Controller");
    $scope.signUp = function () {
        console.log("Sign Up Button pressed");
    }


})

myApp.controller('homeController', function ($scope) {
    console.log("home Controller");
})


/*myApp.config(['$httpProvider', function ($httpProvider) {
    // Intercept POST requests, convert to standard form encoding
    $httpProvider.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
    $httpProvider.defaults.transformRequest.unshift(function (data, headersGetter) {
        var key, result = [];

        if (typeof data === "string")
            return data;

        for (key in data) {
            if (data.hasOwnProperty(key))
                result.push(encodeURIComponent(key) + "=" + encodeURIComponent(data[key]));
        }
        return result.join("&");
    });
}]);*/