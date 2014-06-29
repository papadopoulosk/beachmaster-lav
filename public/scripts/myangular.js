var beachApp = angular.module('beachApp',[]);

beachApp.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('%%');
  $interpolateProvider.endSymbol('%%');
});

function beachController($scope, $http, $location){
    var markers = [];
    
    //Update Prefecture
    $scope.updatePrefecture = function(){
       prefecture = $scope.prefecture;
       $("#map").gmap3({clear:markers});
       loadBeaches(prefecture,null);
    };

    //Update municipality
    $scope.updateMunicipality = function(){
       prefecture = $scope.prefecture;
       municipality = $scope.municipality;
       $("#map").gmap3({clear:markers});
       loadBeaches(prefecture,municipality);
    };

    var loadBeaches = function(prefecture,municipality){
        
        if(typeof(prefecture)==='undefined') prefecture = "";
        if(typeof(municipality)==='undefined') municipality = "";
        url = 'api/v1/beach/all?';
        if (prefecture!="" && prefecture !=null) {
            url = url + 'prefecture='+prefecture;
        }
        if(municipality!="" && municipality!=null){
                url = url+'&municipality='+municipality;
        }
        console.log(url);        
        $scope.beaches = [];
        $scope.error = "";
        $scope.orderAttr="";
        
        $http({method: 'GET', url: url}).
            success(function(data, status, headers, config) {
            // this callback will be called asynchronously
            // when the response is available
           markers = data;
           $scope.beaches = data;
            var counter = 0;
            var values = [];
            for (var beach in data)
                {
                    counter++;
                    values.push({
                        latLng:[data[beach].latitude,data[beach].longitude],
                        data:data[beach].name
                    });
                }
               $scope.orderAttr='name'; 
             //Custom function to Initiate Gmap plugin
            initGmap(values);
        }).error(function(data, status, headers, config) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.
          $scope.error = 'Something went terribly wrong. Please contact us about the issue.';
        });
        
//        $http({method:'GET',url:'/municipality'}).
//            success(function(data){
//                console.log(data);
//                $scope.geo = data;
//            });
    }
    loadBeaches();
}

function reviewController($scope, $http){
    var loadReviews = function(beach){
        $scope.reviews = [];
        $scope.error = "";
        $http({method: 'GET', url: '/review/'+beach}).
            success(function(data, status, headers, config) {
            // this callback will be called asynchronously
            // when the response is available
            $scope.reviews = data;
        }).error(function(data, status, headers, config) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.
          error = 'Something went terribly wrong. Please contact us about the issue.';
        });
    }
    var url = document.URL;
    beach = url.split('/').pop();
    loadReviews(beach);
}
//Gmap plugin in Home page
//Initiated through AngularJS call
function initGmap(dataValues){
    $("#map").gmap3({
           getgeoloc:{
                callback : function(latLng){
                  if (latLng){
                    $(this).gmap3({
                      marker:{ 
                        //latLng:latLng
                      },
                      map:{
                        options:{
                         // zoom: 10
                        }
                      }
                    });
                  }
                }
              },
           options:{
                //zoom: 10
           },
           //Start of marker section
            marker:{
               values:dataValues,
               options:{
                 draggable: false
               },
               events:{
                    click: function(marker, event, context){
                      var name="";  
                      var map = $(this).gmap3("get"),
                        infowindow = $(this).gmap3({get:{name:"infowindow"}});
                      if (infowindow){
                        infowindow.open(map, marker);
                        infowindow.setContent(context.data);
                        
                        $("#searchFilter").val(context.data);
                        $("#searchFilter").trigger('input');
                      } else {
                        $(this).gmap3({
                          infowindow:{
                            anchor:marker, 
                            options:{content: context.data}
                          }
                        });
                      }
                    },
                    mouseout: function(){
                      var infowindow = $(this).gmap3({get:{name:"infowindow"}});
                      if (infowindow){
                        infowindow.close();
                      }
                    }
                  }
            }//End of marker section
          ,autofit:{}
          });
}