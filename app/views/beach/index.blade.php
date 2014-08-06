@extends('layout.default')
@section('content')

<div class="row">
    <h3>Discover places to visit and beaches to enjoy!</h3>
</div>
<div class="row">
    <div id="map" class="col-md-7 mapCentral"></div>    
</div>
<div  id="beachContent" ng-controller="beachController">
<div class="row mainFilterBar">

    <!-- Template for Angular view -->
    <div class="col-xs-12 col-md-3">
        <pagination total-items="totalItems" ng-model="currentPage" class="pagination" max-size="maxSize" items-per-page="numPerPage" previous-text="&lsaquo;&lsaquo;" next-text="&rsaquo;&rsaquo;" ng-change="pageChanged()"></pagination>
    </div>
    <div class="col-xs-12 col-md-3">
        <pre>Total results: %% totalItems %%</pre>
    </div>
    <div class="col-xs-12 col-md-3">
        <div>
            <select class="form-control nullable" ng-model="prefecture"  ng-change="updatePrefecture()">
                    <option value="">--Prefecture--</option>
                @foreach ($prefectures as $prefecture)
                    <option value="{{ $prefecture['id'] }}">{{ $prefecture['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <div class="col-xs-12 col-md-3">
        <div class="">
            <select class="form-control nullable" ng-model="municipality" ng-options="municipality.id as municipality.name for municipality in municipalities" ng-change="updateMunicipality()">
                    <option value="">--Municipality--</option>
                <!--@foreach ($municipalities as $municipality)-->
                    <!--<option value="%% municipality.id %%"></option>-->
                <!--@endforeach-->
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="row">
        %% error %%                                                                     <!--animate-repeat-->
        <div ng-repeat='beach in beaches | filter:beachFilter | orderBy:orderAttr' class=" col-md-3 col-xs-12">
            <div class="thumbnail">
                <a class="col-xs-6 col-sm-3 col-md-12" href="/beach/%%beach.id%%">
                  <img src="%%beach.imagePath%%" class="media-object">
                </a>
                
                <div class="caption">
                    <a class="textlink" href="/beach/%%beach.id%%">
                        <h4 class="">%% beach.name | limitTo: 20 %%</h4>
                        %% beach.description | limitTo: 60 %%
                    </a><br>
                    <span class="media-body"><a href="/beach/%%beach.id%%" class="btn btn-default btn-xs" role="button">More</a></span>
                    <span ng-if="beach.review_count > 0" class="media-body">
                        <span>Rate: </span><span class="label label-info">%% beach.avg_rate %%</span>
                    </span>
                    <span ng-if="beach.review_count > 0" class="media-body">
                        <span>Reviews: </span><span class="label label-info">%%beach.review_count%%</span>
                    </span>
                    <span ng-if="beach.review_count < 1" class="media-body">
                        <span>No reviews yet!</span>
                    </span>
                </div>
            </div>    
        </div> 
    </div>
    <!-- End of AngularJS View -->
</div>
</div> <!-- End of ng-controller -->


@stop
