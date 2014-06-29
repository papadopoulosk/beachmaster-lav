@extends('layout.default')
@section('content')
<div class="row">
    <div id="map" class="col-md-8 col-md-offset-1 mapCentral"></div>    
</div>
<div ng-controller="beachController">
<div class="row">
<hr>
    <!-- Template for Angular view -->
    <div class="col-xs-2">
        <input type="search" id="searchFilter" class="form-control" placeholder="Search for beaches" ng-model="beachFilter">
    </div>
    <div class="col-xs-2">
        <select class="form-control" ng-model="orderAttr">
            <option value="name">Alphabetical</option>
            <option value="avg_rate">Rate</option>
            <option value="review_count">Number of reviews</option>
        </select>
    </div>
    
    <div class="col-xs-2">
        <select class="form-control nullable" ng-model="prefecture"  ng-change="updatePrefecture()">
                <option value="">--Prefecture--</option>
            @foreach ($prefectures as $prefecture)
                <option value="{{ $prefecture['id'] }}">{{ $prefecture['name'] }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-xs-2">
        <select class="form-control nullable" ng-model="municipality"  ng-change="updateMunicipality()">
                <option value="">--Municipality--</option>
            @foreach ($municipalities as $municipality)
                <option value="{{ $municipality['id'] }}">{{ $municipality['name'] }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-xs-2">
        <a href="{{ URL::to('/beach/create') }}" class="btn btn-primary" role="button">Add new beach</a>
    </div>
</div>

<div class="row">
<hr>
    
    <div>
        %% error %%
        <div ng-repeat='beach in beaches | filter:beachFilter | orderBy:orderAttr' class="col-md-4">
<!--            <a class="pull-right" href="/beach/%%beach.id%%">
              <img src="%%beach.imagePath%%" class="media-object">
            </a>
            -->
            <div class="media-body">
              <h4 class="media-heading">%%beach.name%%</h4>
              %%beach.description%%
            </div>
            <div ng-if="beach.review_count > 0" clas="media-body">
                <hr>
                <span><span class="label label-success">%% beach.avg_rate %%</span>&nbsp; Rate</span>
            </div>
            <div ng-if="beach.review_count > 0" clas="media-body">
                <span><span class="label label-success">%%beach.review_count%%</span>&nbsp;# of reviews</span>
            </div>
            <div ng-if="beach.review_count < 1" clas="media-body">
                <hr>
                <span><span class="label label-success">Be the first to leave a review and rate the spot! :)</span>
            </div>
            <p><a href="/beach/%%beach.id%%" class="" role="button">More...</a></p>
        </div>        
    </div>
    <!-- End of AngularJS View -->
</div>
</div> <!-- End of ng-controller -->
@stop
