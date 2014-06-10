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
          //Empty Callback
        });
    }
    loadBeaches();
}

function neighborbeachController($scope, $http){
    var loadBeaches = function($data){
        $scope.beaches = [];
//        $.ajax({
//            url: "api/v1/neighbors",
//            type: "post",
//            data: $data,
//            success: function(data){
//                $("#test").html(data);
//                //$scope.beaches = data;
//            },
//            error:function(){
//                alert("failure");
//            }
//        });
    }
    loadBeaches($data);
}