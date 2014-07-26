var beachApp = angular.module('beachApp',[]);
//var beachApp = angular.module('beachApp', ['ui.bootstrap']);

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
       $scope.municipality = '';
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
        if (prefecture!=="" && prefecture !==null) {
            url = url + 'prefecture='+prefecture;
        }
        if(municipality!=="" && municipality!==null){
                url = url+'&municipality='+municipality;
        }
        console.log(url);        
        $scope.beaches = [];
        $scope.error = "";
        $scope.orderAttr="";
        
        $scope.currentPage = 1;
        $scope.numPerPage = 4;
        $scope.maxSize = 5;
        
        $http({method: 'GET', url: url}).
            success(function(data, status, headers, config) {
            // this callback will be called asynchronously
            // when the response is available
            //var data = data['data'];
            //console.log(data);
            if (data!==false){
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
                $('#beachContent').fadeIn('slow')
               
            }
        }).error(function(data, status, headers, config) {
          // called asynchronously if an error occurs
          // or server returns response with an error status.
          $scope.error = 'No beaches found! :-(';
        });
        
    };
    loadBeaches();
}

function recommendationController($scope,$http){
    
    $scope.content =  "Click on the map to see if your beach already exists!";
    $scope.neighbors = "";
    
    addMarker();
    function addMarker(){
            
            $("#map").gmap3({
                map: {
                    options: {
                        center: [39.50404070558415, 23.818359375],
                        zoom: 7,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        mapTypeControl: false,
                        
                        navigationControl: true,
                        scrollwheel: true
                    },
                    events: {
                        click: function (map, event) {
                            //$("#recommendation").html('<p class="well">Checking...  <img src="/images/loading.gif"></p>');
                            $scope.content = "Searching...";
                            $(this).gmap3(
                               {
                                   clear:{id:'tempMarker'},
                                   marker: {
                                       latLng: event.latLng,
                                       id:"tempMarker"
                                   },
                                   getaddress:{
                                    latLng:event.latLng,
                                    callback:function(results){
                                        municipality = results && results[1] ? results && results[0].address_components[2].short_name: "no address";
                                        prefecture = results && results[1] ? results && results[0].address_components[3].short_name: "no address";
                                        content = results && results[1] ? results && "Result "+results[0].address_components[2].short_name+" - "+results[0].address_components[3].short_name : "no address";
                                        //console.log(content);
                                        $('#municipality').val(municipality);
                                        $('#prefecture').val(prefecture);
                                    }
                                  }
                               });
                            $('#latitude').val(event.latLng.lat());
                            $('#longitude').val(event.latLng.lng());
                            
                            //Retrieve nearest beaches
                            
                            data = "lat="+event.latLng.lat()+"&lng="+event.latLng.lng();
                            SearchNeighbors(data);
                        }
                    }
                }
            });
            
        }
    function SearchNeighbors(data){
        console.log('/api/v1/beach/neighbors?'+data);
        $http({method: 'GET', url: '/api/v1/beach/neighbors?'+data})
            .success(function(data, status, headers, config) {
                if (status===200){
                    $scope.neighbors = data;
                    $scope.content = 'Check the suggestions!';
                } else {
                    $scope.neighbors = "";
                    $scope.content = 'No beaches found! You can go on and add more details';
                }
            }).error(function(data, status, headers, config) {
                    $scope.neighbors = "";
                    $scope.content = 'No beaches found! You can go on and add more details';
            });
        }
        
    $scope.createModal = function(beach){
        $scope.modalName = beach.name;
        $scope.modalDescription = beach.description;
        $scope.modalImagePath = beach.imagePath;
        $scope.modalId = beach.id;
    };
    
    $scope.suggest = function(){
        $('#loading-btn').button('loading');
        var bid = $scope.modalId;
        $http({method: 'GET', url: '/api/v1/beach/suggest/'+bid})
        .success(function(data, status, headers, config) {
            if (status===200){
                $('#loading-btn').button('reset');
                $scope.result = "Success!";
            } else {
                $('#loading-btn').button('reset');
                $scope.result = "Failure during suggestion";
            }
        }).error(function(data, status, headers, config) {
            $('#loading-btn').button('reset');  
            $scope.result = "Failure during suggestion";
        });
    };
}


function reviewController($scope, $filter, $http){
    var loadReviews = function(beach){
        $scope.reviews = [];
        $scope.error = "";
        $http({method: 'GET', url: '/review/'+beach}).
            success(function(data, status, headers, config) {
            // this callback will be called asynchronously
            // when the response is available
            $scope.reviews = $filter('orderBy')(data,'created_at',true);
            
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
                        var map = $(this).gmap3("get");
//                        infowindow = $(this).gmap3({get:{name:"infowindow"}});
                        $("#searchFilter").val(context.data);
                        $("#searchFilter").trigger('input');
//                        if (infowindow){
//                            infowindow.open(map, marker);
//                            infowindow.setContent(context.data);
//                        } else {
//                            $(this).gmap3({
//                              infowindow:{
//                                anchor:marker, 
//                                options:{content: context.data}
//                              }
//                            });
//                        }
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

var PaginationDemoCtrl = function ($scope) {
  $scope.totalItems = 64;
  $scope.currentPage = 4;

  $scope.setPage = function (pageNo) {
    $scope.currentPage = pageNo;
  };

  $scope.pageChanged = function() {
    console.log('Page changed to: ' + $scope.currentPage);
  };

  $scope.maxSize = 5;
  $scope.bigTotalItems = 175;
  $scope.bigCurrentPage = 1;
};