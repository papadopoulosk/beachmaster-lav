@extends('layout.default')
@section('content')
<div id="loadingPage" class="contentDiscover">
    <div class="col-md-6">
        <p class="lead">Please wait...</p>
        <div class="progress">
            <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: {{ rand(10, 30) }}%">
                <span class="sr-only">45% Complete</span>
            </div>
        </div>
    </div>

</div>
<div id="hiddenUntilLoad" class="contentDiscover">

    <div class="row">
        <h3>{{ trans('menu.discoverTitle')}}</h3>
    </div>
    <div class="row">
        <div id="map" class="col-md-7 mapCentral mapCentralWide"></div>

        <!--   <div class="col-md-4">
       
               <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                   <div class="listing listing-default">
                       <div class="shape">
                           <div class="shape-text">buy</div>
                       </div>
                       <div class="listing-content">
                           <h3 class="lead">Standard listing</h3>
                           <p>Buy items on normal prices. No discounts available for this listing.</p>
                       </div>
                   </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                   <div class="listing listing-radius listing-success">
                       <div class="shape">
                           <div class="shape-text">50%</div>
                       </div>
                       <div class="listing-content">
                           <h3 class="lead">Discount listing</h3>
                           <p>Buy now - 50% off.</p>
                       </div>
                   </div>
               </div>
               <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                   <div class="listing listing-danger">
                       <div class="shape">
                           <div class="shape-text">hot</div>
                       </div>
                       <div class="listing-content">
                           <h3 class="lead">Hot Offer</h3>
                           <p>Best selling for this period.</p>
                       </div>
                   </div>
               </div>
       
           </div> -->

    </div>
    <div  id="beachContent" ng-controller="beachController">
        <div class="row mainFilterBar">

            <!-- Template for Angular view -->
            <div class="col-xs-12 col-md-3">
                <pagination total-items="totalItems" ng-model="currentPage" class="pagination" max-size="maxSize" items-per-page="numPerPage" previous-text="&lsaquo;&lsaquo;" next-text="&rsaquo;&rsaquo;" ng-change="pageChanged()"></pagination>
            </div>
            <div class="col-xs-12 col-md-3">
                <pre>{{ trans('menu.totalresults')}}: %% totalItems %%</pre>
            </div>
            <div class="col-xs-12 col-md-3">
                <div>
                    <select class="form-control nullable" ng-model="prefecture"  ng-change="updatePrefecture()">
                        <option value="">--{{ trans('menu.prefecture')}}--</option>
                        @foreach ($prefectures as $prefecture)
                        <option value="{{ $prefecture['id']}}">{{ $prefecture['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-md-3">
                <div class="">
                    <select class="form-control nullable" ng-model="municipality" ng-options="municipality.id as municipality.name for municipality in municipalities" ng-change="updateMunicipality()">
                        <option value="">--{{ trans('menu.municipality')}}--</option>
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
                <div ng-repeat='beach in beaches| filter:beachFilter | orderBy:orderAttr' class=" col-md-3 col-xs-12">
                    <div class="thumbnail">
                        <a class="col-xs-6 col-sm-3 col-md-12" href="/beach/%%beach.slug%%">
                            <img src="%%beach.imagePath%%" class="media-object grayscale">
                        </a>

                        <div class="caption">
                            <a class="textlink" href="/beach/%%beach.id%%">
                                <h4 class="">%% beach.name | limitTo: 20 %%</h4>
                                %% beach.description | limitTo: 60 %%
                            </a><br>
                            <span class="media-body"><a href="/beach/%%beach.slug%%" class="btn btn-default btn-xs" role="button">{{ trans('menu.more')}}</a></span>
                            <span ng-if="beach.review_count > 0" class="media-body">
                                <span>{{ trans('menu.rate')}}: </span><span class="label label-info">%% beach.avg_rate %%</span>
                            </span>
                            <span ng-if="beach.review_count > 0" class="media-body">
                                <span>{{ trans('menu.reviews')}}: </span><span class="label label-info">%%beach.review_count%%</span>
                            </span>
                            <span ng-if="beach.review_count < 1" class="media-body">
                                <span>{{ trans('menu.noReviewsYet')}}!</span>
                            </span>
                        </div>
                    </div>    
                </div> 
            </div>
            <!-- End of AngularJS View -->
        </div>
    </div> <!-- End of ng-controller -->

</div>

<style>
    .shape {
        border-style: solid;
        border-width: 0 70px 40px 0;
        float: right;
        height: 0px;
        width: 0px;
        -ms-transform: rotate(360deg); /* IE 9 */
        -o-transform: rotate(360deg); /* Opera 10.5 */
        -webkit-transform: rotate(360deg); /* Safari and Chrome */
        transform: rotate(360deg);
    }
    .listing {
        background: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        margin: 15px 0;
        overflow: hidden;
    }
    .listing:hover {
        -webkit-transform: scale(1.1);
        -moz-transform: scale(1.1);
        -ms-transform: scale(1.1);
        -o-transform: scale(1.1);
        transform: rotate scale(1.1);
        -webkit-transition: all 0.4s ease-in-out;
        -moz-transition: all 0.4s ease-in-out;
        -o-transition: all 0.4s ease-in-out;
        transition: all 0.4s ease-in-out;
    }
    .shape {
        border-color: rgba(255,255,255,0) #d9534f rgba(255,255,255,0) rgba(255,255,255,0);
    }
    .listing-radius {
        border-radius: 7px;
    }
    .listing-danger {
        border-color: #d9534f;
    }
    .listing-danger .shape {
        border-color: transparent #d9533f transparent transparent;
    }
    .listing-success {
        border-color: #5cb85c;
    }
    .listing-success .shape {
        border-color: transparent #5cb75c transparent transparent;
    }
    .listing-default {
        border-color: #999999;
    }
    .listing-default .shape {
        border-color: transparent #999999 transparent transparent;
    }
    .listing-primary {
        border-color: #428bca;
    }
    .listing-primary .shape {
        border-color: transparent #318bca transparent transparent;
    }
    .listing-info {
        border-color: #5bc0de;
    }
    .listing-info .shape {
        border-color: transparent #5bc0de transparent transparent;
    }
    .listing-warning {
        border-color: #f0ad4e;
    }
    .listing-warning .shape {
        border-color: transparent #f0ad4e transparent transparent;
    }
    .shape-text {
        color: #fff;
        font-size: 12px;
        font-weight: bold;
        position: relative;
        right: -40px;
        top: 2px;
        white-space: nowrap;
        -ms-transform: rotate(30deg); /* IE 9 */
        -o-transform: rotate(360deg); /* Opera 10.5 */
        -webkit-transform: rotate(30deg); /* Safari and Chrome */
        transform: rotate(30deg);
    }
    .listing-content {
        padding: 0 20px 10px;
    }
</style>


@stop
