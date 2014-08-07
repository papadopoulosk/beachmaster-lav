@extends('layout.default')
@section('content')

<div class="row">
    <h1>{{ trans('menu.newBeach')}}</h1>
    <div class="panel panel-info hidden-xs">
        <div class="panel-heading">{{ trans('menu.howTo')}}</div>
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

    <!-- Steps Progress and Details - START -->
    <div class="container" style="">

        <div class="row">
            <div class="row step">
                <div id="div1" class="col-md-3 col-xs-3 substep activestep" onclick="javascript: resetActive(event, 0, 'step-1');">
                    <span class="fa fa-map-marker"></span>
                    <p class="hidden-xs">{{ trans('menu.map')}}</p>
                </div>
                <div class="col-md-3 col-xs-3 substep" onclick="javascript: resetActive(event, 33, 'step-2');">
                    <span class="fa fa-info-circle"></span>
                    <p class="hidden-xs">{{ trans('menu.basicInformation')}}</p>
                </div>
                <div class="col-md-3 col-xs-3 substep" onclick="javascript: resetActive(event, 66, 'step-3');">
                    <span class="fa fa-beer"></span>
                    <p class="hidden-xs">{{ trans('menu.utilities')}}</p>
                </div>
                <div class="col-md-3 col-xs-3 substep" onclick="javascript: resetActive(event, 100, 'step-4');">
                    <span class="fa fa-cloud-upload"></span>
                    <p class="hidden-xs">Submit</p>
                </div>


            </div>
        </div>
        <!--        <div class="row">
                    <div class="progress" id="progress1">
                        <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        </div>
                        <span class="progress-type">Progress</span>
                        <span class="progress-completed">20%</span>
                    </div>
                </div>-->
        {{ Form::open(array(
            'method'=>'post', 
            'url' => '/beach',
            'role'=>'form',
            'files'=>'true'
    )) }} 

        <div class="row setup-content step activeStepInfo" id="step-1">
            <div class="col-xs-12">
                <div class="col-md-12 well" ng-controller="recommendationController">
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
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">{{ trans('menu.close')}}</span></button>
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
                </div>
            </div>
        </div>
        <div class="row setup-content step hiddenStepInfo " id="step-2">
            <div class="col-xs-12">
                <div class="col-md-12 well">
                    <div class="panel-body">
                        <div class="col-md-4">
                            @foreach($errors->all() as $message)
                            <p class="alert alert-warning">{{ $message}}</p>
                            @endforeach

                            <div class="form-group">
                                {{ Form::text ('name',Input::old('name'), array('class'=>'form-control','required'=>'true','placeholder'=> trans('menu.beachName') )) }}
                            </div>
                            <div class="form-group">
                                <div class="fileUpload btn btn-primary">
                                    <span>{{ trans('menu.photo')}}</span>
                                    <input type="file" id="imagePath" name="imagePath" class="upload" />
                                    <!--<p class="help-block">Upload a picture of the beach!</p>-->
                                </div>
                                <p class="help-block">{{ trans('menu.uploadPhoto')}}!</p>
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
        </div>
        <div class="row setup-content step hiddenStepInfo" id="step-3">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    <div class="panel-body">
                        <div class="col-md-3 text-right">
                            <div class="form-group">
                                {{ Form::label('hasBeachBar','Beachbar available') }}&nbsp;&nbsp;&nbsp;
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        {{ Form::radio('hasBeachBar', '1') }} <span class="glyphicon glyphicon-ok"></span>
                                    </label>
                                    <label class="btn btn-primary">
                                        {{ Form::radio('hasBeachBar', '0') }} <span class="glyphicon glyphicon-remove"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('hasWifi','Wifi Access') }}&nbsp;&nbsp;&nbsp;
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        {{ Form::radio('hasWifi', '1') }} <span class="glyphicon glyphicon-ok"></span>
                                    </label>
                                    <label class="btn btn-primary">
                                        {{ Form::radio('hasWifi', '0') }} <span class="glyphicon glyphicon-remove"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('hasShade','Natural Shade Available') }}&nbsp;&nbsp;&nbsp;
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        {{ Form::radio('hasShade', '1') }} <span class="glyphicon glyphicon-ok"></span>
                                    </label>
                                    <label class="btn btn-primary">
                                        {{ Form::radio('hasShade', '0' ) }} <span class="glyphicon glyphicon-remove"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('hasRoadAccess','Accessed by road/car') }}&nbsp;&nbsp;&nbsp;
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary">
                                        {{ Form::radio('hasRoadAccess', '1') }} <span class="glyphicon glyphicon-ok"></span>
                                    </label>
                                    <label class="btn btn-primary">
                                        {{ Form::radio('hasRoadAccess', '0') }} <span class="glyphicon glyphicon-remove"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('hasSand','Sandy beach') }}&nbsp;&nbsp;&nbsp;
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary"> 
                                        {{ Form::radio('hasSand', '1') }} <span class="glyphicon glyphicon-ok"></span>
                                    </label>
                                    <label class="btn btn-primary">
                                        {{ Form::radio('hasSand', '0') }} <span class="glyphicon glyphicon-remove"></span>
                                    </label>
                                </div>
                            </div>

                        </div> 

                        <div class="col-md-3 text-right">
                            <div class="form-group">
                                {{ Form::label('hasParking','Parking Available') }}&nbsp;&nbsp;&nbsp;
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary"> 
                                        {{ Form::checkbox('hasFreeParking', '1') }} <span class="glyphicon glyphicon-thumbs-up">&nbsp;Free</span>
                                    </label>
                                    <label class="btn btn-primary">
                                        {{ Form::checkbox('hasPaidParking', '1') }} <span class="glyphicon glyphicon-euro">&nbsp;Paid</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('hasSunbed','Sunbeds Available') }}&nbsp;&nbsp;&nbsp;
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary"> 
                                        {{ Form::checkbox('hasFreeSunbed', '1') }} <span class="glyphicon glyphicon-thumbs-up">&nbsp;Free</span>
                                    </label>
                                    <label class="btn btn-primary">
                                        {{ Form::checkbox('hasPaidSunbed', '1') }} <span class="glyphicon glyphicon-euro">&nbsp;Paid</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                {{ Form::label('hasUmbrella','Umbrellas Available') }}&nbsp;&nbsp;&nbsp;
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary"> 
                                        {{ Form::checkbox('hasFreeUmbrella', '1') }} <span class="glyphicon glyphicon-thumbs-up">&nbsp;Free</span>
                                    </label>
                                    <label class="btn btn-primary">
                                        {{ Form::checkbox('hasPaidUmbrella', '1') }} <span class="glyphicon glyphicon-euro">&nbsp;Paid</span>
                                    </label>
                                </div>
                            </div>
                        </div> 

                        <div class="col-md-3 text-left">
                            <p>In case you want to suggest additional options, <a href="/contact" title="Contact" >lets us know!</a></p>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="row setup-content step hiddenStepInfo" id="step-4">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    <p class="">If you think, everything is ok, then complete the process!
                        {{ Form::submit(trans('menu.submit'), array('class'=>'btn btn-success')) }}
                    </p>       
                </div>
            </div>
        </div>
        {{ form::close() }}
    </div>

    <style>
        .fa {
            color:  #ad1d28;
        }

        .hiddenStepInfo {
            display: none;
        }

        .activeStepInfo {
            display: block !important;
        }

        .underline {
            text-decoration: underline;
        }

        .step {
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0;
        }
        .step .substeps {
            margin:0;
        }

        .progress {
            position: relative;
            height: 25px;
        }

        .progress > .progress-type {
            position: absolute;
            left: 0px;
            font-weight: 800;
            padding: 3px 30px 2px 10px;
            color: rgb(255, 255, 255);
            background-color: rgba(25, 25, 25, 0.2);
        }

        .progress > .progress-completed {
            position: absolute;
            right: 0px;
            font-weight: 800;
            padding: 3px 10px 2px;
        }

        .step {
            text-align: center;
        }

        .step .col-md-3 {
            /*background-color: #f1f1f1;*/
            border: 0px solid #C0C0C0;
            border-right: none;

        }

        .col-md-3 span.fa {
            -webkit-transition: color 0.6s; /* For Safari 3.1 to 6.0 */
            transition: color 0.6s;
        }

        .col-md-3:hover span.fa {
            color: #e8d069;
        }

        .step .col-md-3:last-child {
            border: 0px solid #C0C0C0;
        }

        .step .col-md-3:first-child {
            border-radius: 5px 0 0 5px;
        }

        .step .col-md-3:last-child {
            border-radius: 0 5px 5px 0;
        }

        .step .col-md-3:hover, .step .col-md-3:hover .fa {
            /*color: #F58723;*/
            cursor: pointer;
        }

        .step .activestep {
            /*color: #F58723;*/
            /*height: 100px;*/
            /*            margin-top: -7px;
                        padding-top: 7px;*/
            /*            border-left: 2px solid #5CB85C !important;
                        border-right: 2px solid #5CB85C !important;
                        border-top: 2px solid #5CB85C !important;
                        border-bottom: 2px solid #5CB85C !important;*/
            vertical-align: central;
        }
        .activestep .fa {
            color: #F58723;
        }

        .step .fa {
            padding-top: 5px;
            padding-bottom: 5px;
            font-size: 40px;
        }
        .setup-content{
            min-height: 480px;
        }

    </style>

    <script type="text/javascript">
        function resetActive(event, percent, step) {
            $(".progress-bar").css("width", percent + "%").attr("aria-valuenow", percent);
            $(".progress-completed").text(percent + "%");

            $("div").each(function() {
                if ($(this).hasClass("activestep")) {
                    $(this).removeClass("activestep");
                }
            });
            console.log(event.target.className);
            if (event.target.className === "col-md-3 col-xs-3 substep") {
                $(event.target).addClass("activestep");

            }
            else {//if (event.target.className == "substep") {
                $(event.target.parentNode).addClass("activestep");
            }

            hideSteps();
            showCurrentStepInfo(step);
        }

        function hideSteps() {
            $("div").each(function() {
                if ($(this).hasClass("activeStepInfo")) {
                    $(this).removeClass("activeStepInfo");
                    $(this).addClass("hiddenStepInfo");
                }
            });
        }

        function showCurrentStepInfo(step) {
            var id = "#" + step;
            $(id).addClass("activeStepInfo");
        }
    </script>


</div>

@stop