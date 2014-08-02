@extends('layout.default')
@section('content')

<div class="row">
    <!-- Nav tabs -->
    
    <div class="row-fluid" ng-controller="singleBeachController">
    <div class="col-md-12 well well-sm">
        <p class="pull-right"><a class="report" ng-click="reportBeach({{ $beach['id'] }})" href="">%% reportStatus %% </a></p>
        
        <h2>{{{ $beach['name'] }}}&nbsp; <button ng-show="!showEditForm" type="button" class="btn btn-default btn-sm" ng-click="editable()"><span class="glyphicon glyphicon-pencil"></span></button></h2>
        <p ng-show="!showEditForm" id="beachDescriptionField">{{{ $beach['description'] }}}</p>
        
        <div ng-show="showEditForm">
            
        
        {{ Form::model($beach) }}
        <div class="form-group">
        {{ Form::textarea('description',null,array('class'=>'form-control','required'=>'true','id'=>'newDescription')) }}
        </div>
        <div class="form-group">
        {{ Form::button('Save', array('class'=>'btn btn-success', "ng-click"=>"update(".$beach['id'].")")) }}
        {{ Form::button('Cancel', array('class'=>'btn btn', "ng-click"=>"editable()")) }}
        </div>
        {{ Form::close() }}
        
        </div>
        
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
            <div class="col-md-9">    
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" ng-controller="imageController">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php $count = 0; ?>
                        @foreach ($images as $image)
                              <li data-target="#carousel-example-generic" data-slide-to="{{ $count }}" <?php if ($count==0) echo 'class="active"'; ?>></li>
                              <?php $count++; ?>
                        @endforeach
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php $count = 1; ?>
                        @foreach ($images as $image)
                            <div class="item <?php if ($count==1) echo "active"?>">
                                <img src="{{ $image['imagePath'] }}" alt="...">
                                <div class="carousel-caption  hidden-xs">
                                    <p class="label label-primary">Uploaded on: {{ date_format(date_create($image['created_at']), 'd-m-Y') }}</p>
                                    <p class=""><a class="report label relabel-warning bringToTop" ng-click="reportImage({{ $image['id'] }})" href="javascript:void(0)">Report image</a></p>
                                </div>
                            </div>
                        <?php $count=0; ?>
                        @endforeach
                    </div>
                    <!-- Controls -->
<!--                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>-->
                </div>
            </div>
            <!-- Start of Carousel -->
            <!--<div class="col-md-9 col-xs-12">-->
<!--                <div id="carousel-example-generic" class="carousel" data-ride="carousel" ng-controller="imageController"> 
                     Indicators 
                    <ol class="carousel-indicators">
                      <?php $count = 1; ?>
                      @foreach ($images as $image)
                            <li data-target="#carousel-example-generic" data-slide-to="0" <?php if ($count==1) echo 'class="active"'; ?>></li>
                            <?php $count=0; ?>
                      @endforeach
                    </ol>

                     Wrapper for slides 
                    <div class="carousel-inner">
                        <?php $count = 1; ?>
                        @foreach ($images as $image)
                            <div class="item <?php if ($count==1) echo "active"?>" >
                                <img src="{{ $image['imagePath'] }}" alt="image_{{ $image['id'] }}">
                                <div class="carousel-caption  hidden-xs">
                                    <p class="label label-primary">Uploaded on: {{ date_format(date_create($image['created_at']), 'd-m-Y') }}</p>
                                    <p class=""><a class="report label relabel-warning bringToTop" ng-click="reportImage({{ $image['id'] }})" href="javascript:void(0)">Report image</a></p>
                                </div>
                            </div>
                            <?php $count=0; ?>
                        @endforeach
                    </div>-->

                    <!-- Controls -->
<!--                    <a class="left carousel-control hidden-xs" href="#carousel-example-generic" role="button" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control  hidden-xs" href="#carousel-example-generic" role="button" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>-->
            <!--</div>-->
            <!-- End of carousel -->
            <div class="col-md-3 col-xs-12">
                <br>
                <div class="bringToTop col-md-12 col-xs-12">
                {{ Form::open(array(
                    'method'=>'post', 
                    'url' => '/image',
                    'role'=>'form',
                    'files'=>'true'
                 )) }}
                    <div class="fileUpload btn btn-primary">
                        <span>New image</span>
                        <input type="file" id="imagePath" name="imagePath" class="upload" />
                    </div> 
                    {{ Form::hidden ('bid',$beach['id'], array('id'=>'bid','required'=>'true')) }}
                    {{ Form::submit('Upload!', array('class'=>'btn btn-success')) }}
                {{ Form::close() }}
                </div>
                <div>
                    <p>Restrictions:</p>
                    <ul>
                        <li>Maximum size: 2MB</li>
                        <li>Format: gif, jpeg, jpg, png</li>
                    </ul>
                </div>
                
            </div>
        </div>
        <hr>
        <div class="row-fluid">
            <h3>Latest comments</h3>
            <div ng-controller="reviewController">
                <div ng-repeat='review in reviews | orderBy:review.created_at | limitTo:4' class="col-md-3 col-xs-12">
                    <blockquote>
                        <p><span class="glyphicon glyphicon-search"></span>&nbsp; %% review.title %% (Rate: %% review.rate %%)</p>
                        <footer> %% review.text %%</footer> 
                        <span><a class='report' ng-click="reportReview(review.id)" href="javascript:void(0)">%% review.reportStatus %%</a></span><span class="report">&nbsp;%% review.created_at %%</span>
                    </blockquote>
                </div>
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
            <!--{{ Form::selectRange('rate', 1, 5,null, array('class'=>'form-control','required'=>'true')) }}-->
            <span class="star-rating">
            {{ Form::radio("rate", "1") }}<i></i>
            {{ Form::radio("rate", "2") }}<i></i>
            {{ Form::radio("rate", "3") }}<i></i>
            {{ Form::radio("rate", "4") }}<i></i>
            {{ Form::radio("rate", "5") }}<i></i>
            </span>
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
        {{ Form::open(array(
            'method'=>'POST', 
            'url' => '/utilities',
            'role'=>'form'
         )) }}
         <div class="col-md-6">
             <div class="form-group">
                {{ Form::label('hasBeachBar','Beachbar available') }}
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary {{ ($utility[0]['hasBeachbar']== '1') ? "active" : "" }}">
                      {{ Form::radio('hasBeachBar', '1' ,($utility[0]['hasBeachbar']== '1') ? true : false) }} <span class="glyphicon glyphicon-ok"></span>
                    </label>
                    <label class="btn btn-primary {{ ($utility[0]['hasBeachbar']== '0') ? "active" : "" }}">
                      {{ Form::radio('hasBeachBar', '0' ,($utility[0]['hasBeachbar']== '0') ? true : false) }} <span class="glyphicon glyphicon-remove"></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('hasWifi','Wifi Access') }}
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary {{ ($utility[0]['hasWifi']== '1') ? "active" : "" }}">
                    {{ Form::radio('hasWifi', '1',($utility[0]['hasWifi']== '1') ? true : false) }} <span class="glyphicon glyphicon-ok"></span>
                    </label>
                    <label class="btn btn-primary {{ ($utility[0]['hasWifi']== '0') ? "active" : "" }}">
                    {{ Form::radio('hasWifi', '0',($utility[0]['hasWifi']== '0') ? true : false) }} <span class="glyphicon glyphicon-remove"></span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('hasShade','Natural Shade Available') }}
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary {{ ($utility[0]['hasShade']== '1') ? "active" : "" }}">
                    {{ Form::radio('hasShade', '1',($utility[0]['hasShade']== '1') ? true : false) }} <span class="glyphicon glyphicon-ok"></span>
                </label>
                <label class="btn btn-primary {{ ($utility[0]['hasShade']== '0') ? "active" : "" }}">
                    {{ Form::radio('hasShade', '0',($utility[0]['hasShade']== '0') ? true : false) }} <span class="glyphicon glyphicon-remove"></span>
                </label>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('hasRoadAccess','Accessed by road/car') }}
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary {{ ($utility[0]['hasRoadAccess']== '1') ? "active" : "" }}">
                    {{ Form::radio('hasRoadAccess', '1',($utility[0]['hasRoadAccess']== '1') ? true : false) }} <span class="glyphicon glyphicon-ok"></span>
                </label>
                <label class="btn btn-primary {{ ($utility[0]['hasRoadAccess']== '0') ? "active" : "" }}">
                    {{ Form::radio('hasRoadAccess', '0',($utility[0]['hasRoadAccess']== '0') ? true : false) }} <span class="glyphicon glyphicon-remove"></span>
                </label>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('hasSand','Sandy beach') }}
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary {{ ($utility[0]['hasSand']== '1') ? "active" : "" }}"> 
                    {{ Form::radio('hasSand', '1',($utility[0]['hasSand']== '1') ? true : false) }} <span class="glyphicon glyphicon-ok"></span>
                </label>
                <label class="btn btn-primary {{ ($utility[0]['hasSand']== '0') ? "active" : "" }}">
                    {{ Form::radio('hasSand', '0',($utility[0]['hasSand']== '0') ? true : false) }} <span class="glyphicon glyphicon-remove"></span>
                </label>
                </div>
            </div>
             
         </div> 
        
         <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('hasParking','Parking Available') }}
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary {{ ($utility[0]['hasFreeParking']== '1') ? "active" : "" }}"> 
                    {{ Form::checkbox('hasFreeParking', '1',($utility[0]['hasFreeParking']== '1') ? true : false) }} <span class="glyphicon glyphicon-thumbs-up">&nbsp;Free</span>
                </label>
                <label class="btn btn-primary {{ ($utility[0]['hasPaidParking']== '1') ? "active" : "" }}">
                    {{ Form::checkbox('hasPaidParking', '1',($utility[0]['hasPaidParking']== '1') ? true : false) }} <span class="glyphicon glyphicon-euro">&nbsp;Paid</span>
                </label>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('hasSunbed','Sunbeds Available') }}
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary {{ ($utility[0]['hasFreeSunbed']== '1') ? "active" : "" }}"> 
                        {{ Form::checkbox('hasFreeSunbed', '1',($utility[0]['hasFreeSunbed']== '1') ? true : false) }} <span class="glyphicon glyphicon-thumbs-up">&nbsp;Free</span>
                    </label>
                    <label class="btn btn-primary {{ ($utility[0]['hasPaidSunbed']== '1') ? "active" : "" }}">
                    {{ Form::checkbox('hasPaidSunbed', '1',($utility[0]['hasPaidSunbed']== '1') ? true : false) }} <span class="glyphicon glyphicon-euro">&nbsp;Paid</span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('hasUmbrella','Umbrellas Available') }}
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-primary {{ ($utility[0]['hasFreeUmbrella']== '1') ? "active" : "" }}"> 
                    {{ Form::checkbox('hasFreeUmbrella', '1',($utility[0]['hasFreeUmbrella']== '1') ? true : false) }} <span class="glyphicon glyphicon-thumbs-up">&nbsp;Free</span>
                    </label>
                    <label class="btn btn-primary {{ ($utility[0]['hasPaidUmbrella']== '1') ? "active" : "" }}">
                        {{ Form::checkbox('hasPaidUmbrella', '1',($utility[0]['hasPaidUmbrella']== '1') ? true : false) }} <span class="glyphicon glyphicon-euro">&nbsp;Paid</span>
                    </label>
                </div>
            </div>
        </div> 
         <div class="form-group">
            {{ Form::hidden ('beach_id',$utility[0]['beach_id'], array('required'=>'true')) }}
        </div>
        {{ Form::submit('Update utilities!', array('class'=>'btn btn-success')) }}
        {{ Form::close() }}
</div>    
<!--End of pane Utilities-->
<script>
$(':radio').change(
  function(){
    $('.choice').text( this.value + ' stars' );
  } 
);
</script>
</div>
@stop
