var beachApp = angular.module('beachApp',[]);

beachApp.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('%%');
  $interpolateProvider.endSymbol('%%');
});

function beachController($scope, $http){
    var loadBeaches = function(){
        $scope.beaches = [];
        $http({method: 'GET', url: 'api/v1/beaches'}).
            success(function(data, status, headers, config) {
            // this callback will be called asynchronously
            // when the response is available
            $scope.beaches = data;
        }).error(function(data, status, headers, config) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.
        });
    }
    loadBeaches();
}


//beachApp.controller('beachCtrl',function ($scope){
    //$http.get('http://localhost:8000/api/v1/beaches/').success(function(data, status, headers, config) {
    
    //$scope.beaches = [{"name":"aaaaaa","description":"asd"},{"name":"aaaaaa","description":"asd"}];
    //$scope.flag = "asdasdasd";
    //}).error(function(data, status, headers, config) {
       //log error
    //});
//});
