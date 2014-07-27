@extends('layout.default')
@section('content')

<div class="row">
    <!-- Nav tabs -->
    
    <div class="row-fluid" ng-controller="singleBeachController">
    <div class="col-md-12 well well-sm">
        <p class="pull-right"><a class="report" ng-click="reportBeach({{ $beach['id'] }})" href="">%% reportStatus %% </a></p>
        
        <h2>{{ $beach['name'] }}</h2>
        <p ng-show="!showEditForm" id="beachDescriptionField">{{ $beach['description'] }}</p>
        
        <div ng-show="showEditForm">
            
        
        {{ Form::model($beach) }}
        <div class="form-group">
        {{ Form::textarea('description',null,array('class'=>'form-control','required'=>'true','id'=>'newDescription')) }}
        </div>
        <div class="form-group">
        {{ Form::button('Update', array('class'=>'btn btn-success', "ng-click"=>"update(".$beach['id'].")")) }}
        </div>
        {{ Form::close() }}
        
        </div>
        <button ng-show="!showEditForm" type="button" class="btn btn-default btn-sm" ng-click="editable()"><span class="glyphicon glyphicon-pencil"></span></button>
        <p id="beachLastUpdateField" class="report">Last updated: {{ $beach['updated_at'] }}</p>
    </div>
    
    </div>
    <div class="col-md-4">
        <ul class="nav nav-tabs" role="tablist">
          <li class="active"><a href="#gallery" role="tab" data-toggle="tab">Image Gallery</a></li>
          <li><a href="#utilities" role="tab" data-toggle="tab">Utilities</a></li>
          <li class="dropdown">
                <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown">Reviews <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
                  <li><a href="#reviews" tabindex="-1" role="tab" data-toggle="tab">View</a></li>
                  <li class=""><a href="#addreview" tabindex="-1" role="tab" data-toggle="tab">New</a></li>
                </ul>
          </li>
        </ul>
    </div>
</div>

<div class="tab-content">
<!--Start of pane Gallery-->
<div class="row-fluid tab-pane fade in active" id="gallery">
    <div class="col-md-12 col-xs-12">        
        <div class="row">
            <!-- Start of Carousel -->
            <div id="carousel-example-generic" class="carousel slide col-md-9 col-xs-12" data-ride="carousel" ng-controller="imageController"> 
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <?php $count = 1; ?>
                  @foreach ($images as $image)
                        <li data-target="#carousel-example-generic" data-slide-to="0" <?php if ($count==1) echo 'class="active"'; ?>></li>
                        <?php $count=0; ?>
                  @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php $count = 1; ?>
                    @foreach ($images as $image)
                        <div class="item <?php if ($count==1) echo "active"?>" >
                            <img src="{{ $image['imagePath'] }}" alt="...">
                            <div class="carousel-caption">
                                <p class="label label-primary">Uploaded on: {{ date_format(date_create($image['created_at']), 'd-m-Y') }}</p>
                                <p class=""><a class="report label label-warning" ng-click="reportImage({{ $image['id'] }})" href="javascript:void(0)">Report image</a></p>
                            </div>
                        </div>
                        <?php $count=0; ?>
                    @endforeach
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
            <!-- End of carousel -->
            
            <div ng-controller="reviewController">
               
                <div ng-repeat='review in reviews | orderBy:review.created_at' class="col-md-3 col-xs-12">
                    <blockquote>
                        <p><span class="glyphicon glyphicon-search"></span>&nbsp; %% review.title %% (Rate: %% review.rate %%)</p>
                        <footer> %% review.text %%</footer> 
                        <span><a class='report' ng-click="reportReview(review.id)" href="javascript:void(0)">%% reportStatus %%</a></span><span class="report">&nbsp;%% review.created_at %%</span>
                    </blockquote>

                </div>
            </div>
            
        </div>
        <div class="row">
            <br>
            <div class="col-md-12 col-xs-12">
            {{ Form::open(array(
                'method'=>'post', 
                'url' => '/image',
                'role'=>'form',
                'files'=>'true'
             )) }}
            {{ Form::file ('imagePath', array('id'=>'imagePath','required'=>'true')) }}
                <p class="help-block">Upload a picture of the beach!</p>
                {{ Form::hidden ('bid',$beach['id'], array('id'=>'bid','required'=>'true')) }}
                {{ Form::submit('Upload!', array('class'=>'btn btn-success')) }}
            {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<!--End of Pane Gallery-->
<!--Start of Pane Add Review-->
<div class="row-fluid tab-pane fade" id="addreview">
<div class="row">
    <div class="col-md-4">
    {{ Form::open(array('method'=>'post', 'url' => '/review','role'=>'form')) }}
            
                @foreach($errors->all() as $message)
                    <p class="alert alert-warning">{{ $message }}</p>
                @endforeach
            
        <div class="form-group">
            {{ Form::text ('title',Input::old('title'), array('class'=>'form-control','placeholder'=>'Review Title','required'=>'true')) }}
        </div>
        <div class="form-group">
            {{ Form::selectRange('rate', 1, 5,null, array('class'=>'form-control','required'=>'true')) }}            
        </div>
        <div class="form-group">
            {{ Form::textarea ('text',Input::old('text'), array('class'=>'form-control','placeholder'=>'Type here your review..','required'=>'true')) }}
        </div>
          
        {{ Form::hidden('beachId', $beach['id']) }}
        
        {{ Form::submit('Submit!', array('class'=>'btn btn-success')) }}
    {{ Form::close() }}    
    </div>
</div>
</div>
<!--End of Pane Add Review-->

<!--Start of Pane Read Reviews-->
<div class="row-fluid tab-pane fade" id="reviews">
    <div class="row">
        <div class="col-md-3">
            <h3>Comments</h3>
        </div>
        
        <div class="col-md-3">
            <!-- Placeholder -->
       </div>
    </div>
    <div ng-controller="reviewController">
        <div ng-repeat='review in reviews' class="col-md-12">
            <blockquote>
                <p><span class="glyphicon glyphicon-search"></span>&nbsp; %% review.title %% (Rate: %% review.rate %%)</p>
                <footer> %% review.text %%</footer> 
                <footer> %% review.created_at %% </footer>
                <span><a class='report' href="/report/review/%% review.id %%">Report</a></span>
            </blockquote>
            
        </div>
    </div>
</div>
<!--End of Pane Read Reviews-->

<!--Start of pane Utilities-->
<div class="row-fluid tab-pane fade" id="utilities">
    <div class="">
        {{ Form::open(array(
            'method'=>'POST', 
            'url' => '/utilities',
            'role'=>'form'
         )) }}
        <div class="form-group col-xs-12 col-md-6">
            {{ Form::label('hasBeachBar','Beachbar available') }}
            {{ Form::radio('hasBeachBar', '1' ,($utility[0]['hasBeachbar']== '1') ? true : false) }} Yes
            {{ Form::radio('hasBeachBar', '0' ,($utility[0]['hasBeachbar']== '0') ? true : false) }} No
        </div>
        <div class="form-group col-xs-12 col-md-6">
            {{ Form::label('hasWifi','Wifi Access') }}
            {{ Form::radio('hasWifi', '1',($utility[0]['hasWifi']== '1') ? true : false) }} Yes
            {{ Form::radio('hasWifi', '0',($utility[0]['hasWifi']== '0') ? true : false) }} No
        </div>
        <div class="form-group col-xs-12 col-md-6">
            {{ Form::label('hasShade','Natural Shade Available') }}
            {{ Form::radio('hasShade', '1',($utility[0]['hasShade']== '1') ? true : false) }} Yes
            {{ Form::radio('hasShade', '0',($utility[0]['hasShade']== '0') ? true : false) }} No
        </div>
        <div class="form-group col-xs-12 col-md-6">
            {{ Form::label('hasRoadAccess','Accessed by road/car') }}
            {{ Form::radio('hasRoadAccess', '1',($utility[0]['hasRoadAccess']== '1') ? true : false) }} Yes
            {{ Form::radio('hasRoadAccess', '0',($utility[0]['hasRoadAccess']== '0') ? true : false) }} No
        </div>
        <div class="form-group col-xs-12 col-md-6">
            {{ Form::label('hasSand','Sandy beach') }}
            {{ Form::radio('hasSand', '1',($utility[0]['hasSand']== '1') ? true : false) }} Yes
            {{ Form::radio('hasSand', '0',($utility[0]['hasSand']== '0') ? true : false) }} No
        </div>
        <div class="form-group col-xs-12 col-md-6">
            {{ Form::label('hasParking','Parking Available') }}
            {{ Form::checkbox('hasFreeParking', '1',($utility[0]['hasFreeParking']== '1') ? true : false) }} Free
            {{ Form::checkbox('hasPaidParking', '1',($utility[0]['hasPaidParking']== '1') ? true : false) }} Paid
        </div>
        <div class="form-group col-xs-12 col-md-6">
            {{ Form::label('hasSunbed','Sunbeds Available') }}
            {{ Form::checkbox('hasFreeSunbed', '1',($utility[0]['hasFreeSunbed']== '1') ? true : false) }} Free
            {{ Form::checkbox('hasPaidSunbed', '1',($utility[0]['hasPaidSunbed']== '1') ? true : false) }} Paid
        </div>
        <div class="form-group col-xs-12 col-md-6">
            {{ Form::label('hasUmbrella','Umbrellas Available') }}
            {{ Form::checkbox('hasFreeUmbrella', '1',($utility[0]['hasFreeUmbrella']== '1') ? true : false) }} Free
            {{ Form::checkbox('hasPaidUmbrella', '1',($utility[0]['hasPaidUmbrella']== '1') ? true : false) }} Paid
        </div>
         <div class="form-group">
            {{ Form::hidden ('beach_id',$utility[0]['beach_id'], array('required'=>'true')) }}
        </div>
        {{ Form::submit('Update utilities!', array('class'=>'btn btn-success')) }}
        {{ Form::close() }}
        </div>
</div>    
<!--End of pane Utilities-->

</div>
@stop
