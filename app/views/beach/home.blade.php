@extends('layout.default')
@section('content')
<div class="row">
    <div id="map" class="col-md-8 col-md-offset-1 mapCentral"></div>    
</div>

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
        %% error %%
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
                <span><span class="label label-success">%% beach.avg_rate %%</span>&nbsp; Rate</span>
            </div>
            <div clas="media-body">
                
            <span><span class="label label-success">%%beach.review_count%%</span>&nbsp;# of reviews</span>
            </div>
            <p><a href="details/%%beach.id%%" class="" role="button">More...</a></p>
        </div>        
    </div>
    <!-- End of AngularJS View -->
</div>
@stop
