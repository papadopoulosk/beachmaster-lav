@extends('layout.default')
@section('content')

<div class="row-fluid">
    <div class="panel panel-warning">
        <div class="panel-heading">Go on and give your info!</div>
        <div class="panel-body">
        <p>From here you can input and provide details for new beaches that you like and enjoy! All you have to do is follow the the instructions below! Go ahead!</p>
        <ol class="">
            <li>Locate the beach on the map!</li>
            <ol>
                <li>Check the recommendations below and make sure that your favorite beach is not listed already! No need to double entry everything!</li>
                <li>If your beach is present, just visit it and rate or leave a comment!</li>
                <li>Otherwise go on with the rest of the details!</li>
            </ol>
            <li>Give a name! Type a good description with as much details as you like! Then use an image to upload!</li>
            <li>Fill-in the utilities that one can find there!</li>
            <li>Submit and await for the beach to be approved!</li>
        </ol>    
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#mapPane" role="tab" data-toggle="tab">1) Locate the beach</a></li>
          <li><a href="#detailsPane" role="tab" data-toggle="tab">2) Add details</a></li>
          <li><a href="#utilitiesPane" role="tab" data-toggle="tab">3) Add utilities</a></li>
          <li><a href="#submitPane" role="tab" data-toggle="tab">4) ...and submit!</a></li>
        </ul>
    </div>
</div>
{{ Form::open(array(
            'method'=>'post', 
            'url' => '/beach',
            'role'=>'form',
            'files'=>'true'
         )) }} 
<div class="tab-content">
                 
<!--Start of pane map-->
<div class="row-fluid tab-pane fade in active" id="mapPane">
    <div id="map" class="col-md-8 col-xs-12 mapSecondary"></div>    
    <div id="recommendation" class="col-md-4 col-xs-12">
        <p class="well well-lg">Click on the map to see if your beach already exists!</p>
    </div>
</div>
<!--End of map, start of details-->
<div class="row-fluid tab-pane fade" id="detailsPane">
    <div class="col-md-4">
        @foreach($errors->all() as $message)
            <p class="alert alert-warning">{{ $message }}</p>
        @endforeach
            
        <div class="form-group">
            {{ Form::text ('name',Input::old('name'), array('class'=>'form-control','required'=>'true','placeholder'=>'Beach name')) }}
        </div>
       <div class="form-group">
            {{ Form::file ('imagePath',Input::old('imagePath'), array('class'=>'form-control')) }}
            <p class="help-block">Upload a picture of the beach!</p>
        </div>
        <div class="form-group">
            {{ Form::hidden ('latitude',Input::old('latitude'), array('id'=>'latitude','class'=>'form-control','required'=>'true','placeholder'=>'Geo Latitude')) }}
        </div>
        <div class="form-group">
            {{ Form::hidden ('longitude',Input::old('longitude'), array('id'=>'longitude','class'=>'form-control','required'=>'true', 'placeholder'=>'Geo Longitude')) }}
        </div>
        <div class="form-group">
            {{ Form::hidden ('prefecture',Input::old('prefecture'), array('id'=>'prefecture','class'=>'form-control','required'=>'true')) }}
        </div>
        <div class="form-group">
            {{ Form::hidden ('municipality',Input::old('municipality'), array('id'=>'municipality','class'=>'form-control','required'=>'true')) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::textarea ('description',Input::old('description'), array('class'=>'form-control','required'=>'true','placeholder'=>'Type here a brief description..')) }}
        </div>
    </div>
</div>
<!--End of details, start of utilities-->
<div class="row-fluid tab-pane fade" id="utilitiesPane">
    <div class="col-md-5 col-xs-12">    
        <div class="form-group">
            {{ Form::label('hasBeachBar','Beachbar available') }}
            {{ Form::radio('hasBeachBar', '1') }} Yes
            {{ Form::radio('hasBeachBar', '0') }} No
        </div>
        <div class="form-group">
            {{ Form::label('hasWifi','Wifi Access') }}
            {{ Form::radio('hasWifi', '1') }} Yes
            {{ Form::radio('hasWifi', '0') }} No
        </div>
        <div class="form-group">
            {{ Form::label('hasShade','Natural Shade Available') }}
            {{ Form::radio('hasShade', '1') }} Yes
            {{ Form::radio('hasShade', '0') }} No
        </div>
        <div class="form-group">
            {{ Form::label('hasRoadAccess','Accessed by road/car') }}
            {{ Form::radio('hasRoadAccess', '1') }} Yes
            {{ Form::radio('hasRoadAccess', '0') }} No
        </div>
    </div>
    <div class="col-md-5 col-xs-12">
        <div class="form-group">
            {{ Form::label('hasSand','Sandy beach') }}
            {{ Form::radio('hasSand', '1') }} Yes
            {{ Form::radio('hasSand', '0') }} No
        </div>
        <div class="form-group">
            {{ Form::label('hasParking','Parking Available') }}
            {{ Form::checkbox('hasFreeParking', '1') }} Free
            {{ Form::checkbox('hasPaidParking', '1') }} Paid
        </div>
        <div class="form-group">
            {{ Form::label('hasSunbed','Sunbeds Available') }}
            {{ Form::checkbox('hasFreeSunbed', '1') }} Free
            {{ Form::checkbox('hasPaidSunbed', '1') }} Paid
        </div>
        <div class="form-group">
            {{ Form::label('hasUmbrella','Umbrellas Available') }}
            {{ Form::checkbox('hasFreeUmbrella', '1') }} Free
            {{ Form::checkbox('hasPaidUmbrella', '1') }} Paid
        </div>
    </div>
</div>
<!--End of utilities, start of submit pane-->
<div class="row-fluid tab-pane fade" id="submitPane">
    <div class="row-fluid">
        <p class="">If you think, everything is ok, then complete the process!
            {{ Form::submit('Submit!', array('class'=>'btn btn-success')) }}
        </p>
    </div>
</div>
<!--End of submit pane-->
</div>
{{ form::close() }}

<script type="text/javascript">
        $(document).ready(function () {
            addMarker();
        });
        
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
                            $("#recommendation").html('<p class="well">Checking...  <img src="/images/loading.gif"></p>');
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
                                        console.log(content);
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
        
            $.ajax({
                                url: "/api/v1/beach/neighbors",
                                type: "post",
                                data: data,
                                success: function(data){
                                    if (data!=false){
                                        var obj = $.parseJSON(data);
                                        $("#recommendation").html("");
                                        $.each(obj, function(){
                                            html = '<div class="list-group">';
                                            html += '<a href="{{ URL::to("/api/v1/beach/suggest") }}/'+this['id']+'" class="list-group-item">';
                                            html += '<h5 class="list-group-item-heading">'+this['name']+'</h5>';
                                            html += '<p class="list-group-item-text">'+this['description']+'</p>';
                                            html += '</a>';
                                            html += '</div>';
                                            $("#recommendation").append(html);
                                        });
                                    } else {
                                        $("#recommendation").html('<p id="beachResults" class="alert alert-warning alert-dismissable">  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>No results available</p>');
                                    }
                                },
                                error:function(){
                                    $("#recommendation").html('<p id="beachResults" class="alert alert-warning alert-dismissable">  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>No results available</p>');
                                }
                            });
        }
        
        
    </script>

@stop