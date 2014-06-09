@extends('layout.default')
@section('content')

<div class="row">
    <div class="col-md-4">
    {{ Form::open(array('method'=>'post', 'url' => 'add','role'=>'form')) }}
              
        @foreach($errors->all() as $message)
            <p class="alert alert-warning">{{ $message }}</p>
        @endforeach
            
        <div class="form-group">
            {{ Form::text ('name',Input::old('name'), array('class'=>'form-control','required'=>'true','placeholder'=>'Beach name')) }}
        </div>
        <div class="form-group">
            {{ Form::textarea ('description',Input::old('description'), array('class'=>'form-control','required'=>'true','placeholder'=>'Type here a brief description..')) }}
        </div>
        <div class="form-group">
            {{ Form::text ('latitude',Input::old('latitude'), array('id'=>'latitude','class'=>'form-control','required'=>'true', 'disabled'=>'true','placeholder'=>'Geo Latitude')) }}
        </div>
        <div class="form-group">
            {{ Form::text ('longitude',Input::old('longitude'), array('id'=>'longitude','class'=>'form-control','required'=>'true', 'disabled'=>'true', 'placeholder'=>'Geo Longitude')) }}
        </div>
        <div class="form-group">
            {{ Form::text ('imagePath',Input::old('imagePath'), array('class'=>'form-control','placeholder'=>'Link to an image')) }}
        </div>

        {{ Form::submit('Submit!', array('class'=>'btn btn-success')) }}
    {{ form::close() }}
    </div>

    <div id="map" class="col-md-4 mapSecondary"></div>    
</div>

<div class="row">
    <div ng-controller="beachController">
        <div ng-repeat='beach in beaches' class="col-md-4">
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
    
</div>

<div id="test"></div>
<script type="text/javascript">
        $(document).ready(function () {
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
                            $(this).gmap3(
                               
                               {
                                   clear:{id:'tempMarker'},
                                   marker: {
                                       latLng: event.latLng,
                                       id:"tempMarker"
                                   }
                               });
                             $('#latitude').val(event.latLng.lat());
                             $('#longitude').val(event.latLng.lng());
                            //Retrieve nearest beaches
                            data = "lat="+event.latLng.lat()+"&lng="+event.latLng.lng();
                            //alert(data);
                            $.ajax({
                                url: "api/v1/neighbors",
                                type: "post",
                                data: data,
                                success: function(data){
                                    $("#test").html(data);
                                },
                                error:function(){
                                    alert("failure");
                                }
                            });
                        }
                    }
                }
            });
        });
    </script>

@stop