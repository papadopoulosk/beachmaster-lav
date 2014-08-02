@extends('layout.default')
@section('content')

<div class="row">
    <h1>New Beach!</h1>
    <div class="panel panel-info hidden-xs">
        <div class="panel-heading"><em>"How To"</em> guide - read or ignore</div>
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
    
    {{ Form::open(array(
            'method'=>'post', 
            'url' => '/beach',
            'role'=>'form',
            'files'=>'true'
         )) }} 
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                  Map
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" ng-controller="recommendationController">
                <div class="panel-body">
                    <div id="map" class="col-md-8 col-xs-12 mapSecondary">

                    </div>    
                    <div id="recommendation" class="col-md-4 col-xs-12">
                        <p class="hidden-xs well well-lg">%% content %%</p>
                    </div>
                   
                    <div class="col-md-4 col-xs-12">
                        <div ng-repeat='beach in neighbors' class="list-group">
                            <!-- Modal Triggered by "createModal" function through JS -->
                            <a href="" class="list-group-item" data-toggle="modal" ng-click="createModal(beach)">
                                <p class="list-group-item-heading">%% beach.name %% <span class="hidden-xs">- %% beach.description | limitTo: 30 %%...</span></p>
                            </a>
                        </div>
                    </div>
                  
                </div>
                
                <!--Space for modal-->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Did you mean %% modalName %%?</h4>
                      </div>
                      <div class="modal-body">
                         <div class="row">
                            <div class="col-sm-12 col-md-12">
                              <div class="thumbnail">
                                <img src="%% modalImagePath %%" alt="%% modalName %%">
                                <div class="caption">
                                  <p>%% modalDescription %%</p>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <span class="left">%% result %%</span>
                        <a href="/beach/%% modalId %%" title="View more on new window" target="_blank" class="btn btn-default btn-sm" role="button">More</a>  
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        <a href="" id="loading-btn" data-loading-text="Please wait" title="Suggest" class="btn btn-success btn-sm" role="button" ng-click="suggest()">Suggest</a>  
                      </div>
                    </div>
                  </div>
                </div>
                <!--End of modal-->
            </div> <!--End of Recommendations controller-->
          </div>
        <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                  Basic Information
                </a>
              </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
              <div class="panel-body">
                <div class="col-md-4">
                    @foreach($errors->all() as $message)
                        <p class="alert alert-warning">{{ $message }}</p>
                    @endforeach

                    <div class="form-group">
                        {{ Form::text ('name',Input::old('name'), array('class'=>'form-control','required'=>'true','placeholder'=>'Beach name')) }}
                    </div>
                   <div class="form-group">
                        <div class="fileUpload btn btn-primary">
                    <span>Photo</span>
                    <input type="file" id="imagePath" name="imagePath" class="upload" />
                    <!--<p class="help-block">Upload a picture of the beach!</p>-->
                    </div>
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
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                  Utilities
                </a>
              </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
              <div class="panel-body">
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
            </div>
        </div>
        <div class="row-fluid">
        <p class="well">If you think, everything is ok, then complete the process!
            {{ Form::submit('Submit!', array('class'=>'btn btn-success')) }}
        </p>            
        </div>
        {{ form::close() }}
    </div>
</div>
@stop