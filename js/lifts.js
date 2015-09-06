var app = angular.module('myApp', ['ui.bootstrap']);
app.controller('myController', function($scope, $http, $modal) {

	$scope.submit = function() {
		/*$http.post("http://liftmo.com/api/lifts").success(function(response) {
			$scope.status = response;
		});
		$http.get("http://liftmo.com/api/lifts").success(function(response) {
			$scope.lifts = response.lifts;
		});*/
	}

	$scope.delete = function(liftname) {
		/*$http.delete("http://liftmo.com/api/lifts").success(function(response) {
			$scope.status = response;
		});
		$http.get("http://liftmo.com/api/lifts").success(function(response) {
			$scope.lifts = response.lifts;
		});*/
	}
	
	$scope.post = function() {
		var modalInstance = $modal.open({
			animation: true,
			templateUrl: 'modal.html',
			controller: 'modalController',
			size: '',
			resolve: {
				lift: function() {
					return null;
				}
			}
		});
		modalInstance.result.then(function () {
			/*$http.get("http://liftmo.com/api/lifts").success(function(response) {
				$scope.lifts = response.lifts;
			});*/
    	})

	}

	$scope.put = function(lift) {
		var modalInstance = $modal.open({
			animation: true,
			templateUrl: 'modal.html',
			controller: 'modalController',
			size: '',
			resolve: {
				lift: function() {
					return lift;
				}
			}
		});
		modalInstance.result.then(function () {
			/*$http.get("http://liftmo.com/api/lifts").success(function(response) {
				$scope.lifts = response.lifts;
			});*/
    	})

	}


	$scope.init = function() {
		$scope.status = "Everything working.";
		/*$http.get("http://liftmo.com/api/lifts").success(function(response) {
			$scope.lifts = response.lifts;
		});*/
	}

	$scope.init();
});

app.controller('modalController', function($http, $scope, $modalInstance, lift) {
	$scope.lift = lift;
	
	$scope.submit = function() {
		/*$http.put("http://liftmo.com/api/lifts").success(function(response) {
			$modalInstance.close();
		});*/
	}

	$scope.ok = function () {
		$scope.submit();
  	};

  	$scope.cancel = function () {
    	$modalInstance.dismiss('cancel');
  	};
});