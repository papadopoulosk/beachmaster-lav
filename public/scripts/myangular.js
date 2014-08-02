var beachApp = angular.module("beachApp",['ngAnimate', 'ui.bootstrap']);
//var beachApp = angular.module('beachApp', ['ui.bootstrap']);

beachApp.config(function($interpolateProvider) {
  $interpolateProvider.startSymbol('%%');
  $interpolateProvider.endSymbol('%%');
});

function beachController($scope, $http, $location){
    var markers = [];

    $scope.prefecture;
    $scope.municipality;
    
    $scope.beaches = [];
    $scope.error = "";
    $scope.orderAttr="";

    $scope.numPerPage = 8;
    
    $scope.currentPage = 1;
    $scope.bigCurrentPage = 1;
    
    $scope.bigTotalItems = 0;
    $scope.totalItems = 0;
    $scope.maxSize = 5;
    
    //Update Prefecture
    $scope.updatePrefecture = function(){
       prefecture = $scope.prefecture;

       $scope.municipality = '';
       $scope.currentPage = 1;
       loadBeaches(prefecture,null);
    };

    //Update municipality
    $scope.updateMunicipality = function(){
       prefecture = $scope.prefecture;
       municipality = $scope.municipality;
       
       $scope.currentPage = 1;
       loadBeaches(prefecture,municipality);
    };

    var loadBeaches = function(prefecture,municipality, page){
        $("#map").gmap3({clear:markers});
        //$scope.beaches = "";
        if(typeof(prefecture)==='undefined') prefecture = "";
        if(typeof(municipality)==='undefined') municipality = "";
        if(typeof(page)==='undefined') page = "";
        url = 'api/v1/beach/all?';
        if (prefecture!=="" && prefecture !==null) {
            url = url + 'prefecture='+prefecture;
        }
        if(municipality!=="" && municipality!==null){
                url = url+'&municipality='+municipality;
        }
        if(page!=="" && page!==null){
                url = url+'&page='+page;
        }
        console.log(url);        
        
        
        $http({method: 'GET', url: url})
                .success(function(fullData, status, headers, config) {
            if (fullData!==false){
                data = fullData.data;
                $scope.totalItems = fullData.total;
                $scope.bigTotalItems = fullData.total;;
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
                //$('#beachContent').fadeIn('slow');
            }
        }).error(function() {
//          $scope.error = 'No beaches found! :-(';
          $scope.beaches = '';
          $scope.totalItems = 0;
        });
        
    };
    loadBeaches();
    
    $scope.setPage = function (pageNo) {
      $scope.currentPage = pageNo;
      loadBeaches($scope.prefecture,$scope.municipality, pageNo);
    };

    $scope.pageChanged = function() {
      console.log('Page changed to: ' + $scope.currentPage);
      loadBeaches($scope.prefecture,$scope.municipality, $scope.currentPage);
    };  
}

function singleBeachController($scope, $http) {
    $scope.showEditForm = false;
    $scope.reportStatus = 'Report';
    
    $scope.reportBeach = function(beachId){
        url = '/report/beach/'+beachId;
        $http({method: 'GET', url: url}).
            success(function() {
            $scope.reportStatus = 'Reported';
        }).error(function() {
            $scope.reportStatus = 'Failed report';
        }); 
    };
    
    $scope.editable = function(){
        if ($scope.showEditForm){
            $scope.showEditForm = false;
        } else {
            $scope.showEditForm = true;
        }
    }
    
    $scope.update = function(beachId){
        var description = angular.element('#newDescription').val();
        console.log(description);
        var data = {'description': description, 'id':beachId};
        $http({method: 'POST', url: '/api/v1/beach/updateDescription', data: data}).
            success(function(data) {
            $('#beachDescriptionField').text(description);
            //var returnedData = JSON.parse(data);
            $('#beachLastUpdateField').html('Last Updated: '+data.updated_at);
            $scope.editable();
        }).error(function(data) {
            $scope.editable();
        });
    };
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
        $('#myModal').delay(1800).modal('show');
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

function imageController ($scope, $http){
    
    $scope.reportImage = function(imageId){
        $scope.reportStatus = 'Report';
        $http({method: 'GET', url: '/report/image/'+imageId}).
            success(function() {
            alert("Image Reported");
        }).error(function() {
            //Do nothing.. for now..
        });
    };
}

function reviewController($scope, $filter, $http){
    var loadReviews = function(beach){
        $scope.reportStatus = 'Report';
        $scope.reviews = [];
        $scope.error = "";
        $http({method: 'GET', url: '/review/'+beach}).
            success(function(data) {
                //console.log(data);
            $scope.reviews = $filter('orderBy')(data,'created_at',true);
            $.each(data, function(i, item) {
                data[i].reportStatus = "Report";
            });

        }).error(function() {
          error = 'Something went terribly wrong. Please contact us about the issue.';
        });
    };
    var url = document.URL;
    beach = url.split('/').pop();
    loadReviews(beach);
    
    $scope.reportReview = function(reviewId){
        console.log(reviewId);
        $http({method: 'GET', url: '/report/review/'+reviewId}).
            success(function() {
            //$scope.review.reportStatus = 'Reported';
            $.each($scope.reviews, function(i, item) {
                if (item.id === reviewId) {
                    item.reportStatus = "Reported";
                }
            });
        }).error(function() {
            //$scope.review.reportStatus = 'Error';
        });
    };
}
//Gmap plugin in Home page
//Initiated through AngularJS call
function initGmap(dataValues){
    $("#map").gmap3({
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
                        $("#searchFilter").val(context.data);
                        $("#searchFilter").trigger('input');
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