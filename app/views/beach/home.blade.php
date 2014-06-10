@extends('layout.default')
@section('content')
<div class="row">
    <div id="map" class="col-md-8 col-md-offset-1 mapCentral"></div>    
</div>

<script type="text/javascript">
      $(function(){
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
                          zoom: 8
                        }
                      }
                    });
                  }
                }
              },
           options:{
                zoom: 8
           },
           events:{
            rightclick: function(){
              console.log('Click event fired');
            }
           },
          
           //Start of marker section
            marker:{
               values:[
                    <?php //Counter to decide if trailing coma is injected or not ?>
                    <?php $counter = 0; ?> 
                    <?php //Start of iteration for beaches ?>
                    @foreach($beaches as $key => $value) 
                        <?php $counter = $counter + 1 ?> 
                         <?php //Actuall beaches coordinates ?>
                            {latLng:[{{ $value['latitude'] }},{{ $value['longitude'] }} ], data:"{{ $value['name'] }}"}
                         <?php //Evaluate Counter ?>
                            @if (count($beaches) > $counter)
                                {{","}}
                            @endif
                    @endforeach
               ],
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
            }            
            //End of marker section
          });
      });
</script>
<div class="row">
<hr>

    <!-- Template for Angular view -->
    <div class="col-xs-2">
        <input type="search" id="searchFilter" class="form-control" placeholder="Search for beaches" ng-model="beachFilter">
    </div>
    <div class="col-xs-2">
        <a href="{{ URL::to('add') }}" class="btn btn-primary" role="button">Add new beach</a>
    </div>
</div>

<div class="row">
<hr>
    
    <div ng-controller="beachController">
        <div ng-repeat='beach in beaches | filter:beachFilter' class="col-md-4">
            <a class="pull-right" href="details/%%beach.id%%">
              <img src="http://lorempixel.com/75/75/nature/" class="media-object">
            </a>
            
            <div class="media-body">
              <h4 class="media-heading">%%beach.name%%</h4>
              %%beach.description%%
            </div>
            <div clas="media-body">
                <hr>
                <span><span class="label label-success">%%beach.rate%%</span>&nbsp;Average Rate</span>
            </div>
            <div clas="media-body">
                
            <span><span class="label label-success">%%beach.votes%%</span>&nbsp;#Votes</span>
            </div>
            <p><a href="details/%%beach.id%%" class="" role="button">More...</a></p>
        </div>        
    </div>
    <!-- End of AngularJS View -->
    
<!-- Template for regular view
    @foreach($beaches as $key => $value)
        <div class="media col-md-4">
            <a class="pull-left" href="{{URL::to('details/'.$value['id'])}}">
              <img src="http://lorempixel.com/75/75/nature/" class="media-object">
            </a>
            <div class="media-body">
              <h4 class="media-heading">{{ $value['name'] }}</h4>
              {{ $value['description'] }}
            </div>
            <p><a href="{{URL::to('details/'.$value['id'])}}" class="btn btn-default" role="button">Details</a></p>
        </div>
    @endforeach    
-->    
</div>
@stop
