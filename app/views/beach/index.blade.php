@extends('layout.default')
@section('content')

<div class="row">
    <h2>Discover places to visit and beaches to enjoy!</h2>
</div>

<div class="row">
    <div id="map" class="col-md-8 col-md-offset-1 mapCentral"></div>    
</div>
<div  id="beachContent" ng-controller="beachController">
<div class="row">
    <hr>
    <!-- Template for Angular view -->
    <div class="col-xs-12 col-md-2">
        <input type="search" id="searchFilter" class="form-control" placeholder="Search for beaches" ng-model="beachFilter">
    </div>
    <div class="col-xs-12 col-md-2">
        <select class="form-control" ng-model="orderAttr">
            <option value="name">Alphabetical</option>
            <option value="avg_rate">Rate</option>
            <option value="review_count">Number of reviews</option>
        </select>
    </div>
    
    <div class="col-xs-12 col-md-2">
        <select class="form-control nullable" ng-model="prefecture"  ng-change="updatePrefecture()">
                <option value="">--Prefecture--</option>
            @foreach ($prefectures as $prefecture)
                <option value="{{ $prefecture['id'] }}">{{ $prefecture['name'] }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="col-xs-12 col-md-2">
        <select class="form-control nullable" ng-model="municipality"  ng-change="updateMunicipality()">
                <option value="">--Municipality--</option>
            @foreach ($municipalities as $municipality)
                <option value="{{ $municipality['id'] }}">{{ $municipality['name'] }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="row">
<hr>
    <div class="row">
        %% error %%
        <div ng-repeat='beach in beaches | filter:beachFilter | orderBy:orderAttr' class="col-md-3 col-xs-12 thumbnail">
            <a class="col-xs-5 col-md-7" href="/beach/%%beach.id%%">
              <img src="%%beach.imagePath%%" class="media-object">
            </a>
            
            <div class="caption">
                <a class="textlink" href="/beach/%%beach.id%%">
                    <h4 class="">%% beach.name | limitTo: 20 %%</h4>
                    %% beach.description | limitTo: 50 %%
                </a><br>
                <span class="media-body"><a href="/beach/%%beach.id%%" class="btn btn-default btn-xs" role="button">More</a></span>
                <span ng-if="beach.review_count > 0" class="media-body">
                    <span>Rate: </span><span class="label label-info">%% beach.avg_rate %%</span>
                </span>
                <span ng-if="beach.review_count > 0" class="media-body">
                    <span>Reviews: </span><span class="label label-info">%%beach.review_count%%</span>
                </span>
                <span ng-if="beach.review_count < 1" class="media-body">
                    <span class="label label-info">!</span>
                </span>
            </div>
        </div> 
    </div>
    <!-- End of AngularJS View -->
</div>
</div> <!-- End of ng-controller -->
@stop
