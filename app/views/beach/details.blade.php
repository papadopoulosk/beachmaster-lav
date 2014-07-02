@extends('layout.default')
@section('content')

<div class="row">
    <div class="col-md-8">
<!--        <div class="row">
            <img src="{{ $beach['imagePath'] }}" class="col-md-12">
        </div>-->
        
        <div class="row">
            <!-- Start of Carousel -->
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel"> 
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="{{ $beach['imagePath'] }}" alt="...">
                    <div class="carousel-caption">
                        <p><a href="#">Report image</a></p>
                      </div>
                  </div>
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
        </div>
    </div>
    <div class="col-md-4">
        {{ Form::open(array(
            'method'=>'post', 
            'url' => '#',
            'role'=>'form'
         )) }}
        <div class="form-group">
            {{ Form::label('hasBeachBar','Beachbar available') }}
            {{ Form::radio('hasBeachBar', '1' ,($utility[0]['hasBeachbar']== '1') ? true : false) }} Yes
            {{ Form::radio('hasBeachBar', '0' ,($utility[0]['hasBeachbar']== '0') ? true : false) }} No
        </div>
        <div class="form-group">
            {{ Form::label('hasWifi','Wifi Access') }}
            {{ Form::radio('hasWifi', '1',($utility[0]['hasWifi']== '1') ? true : false) }} Yes
            {{ Form::radio('hasWifi', '0',($utility[0]['hasWifi']== '0') ? true : false) }} No
        </div>
        <div class="form-group">
            {{ Form::label('hasShade','Natural Shade Available') }}
            {{ Form::radio('hasShade', '1',($utility[0]['hasShade']== '1') ? true : false) }} Yes
            {{ Form::radio('hasShade', '0',($utility[0]['hasShade']== '0') ? true : false) }} No
        </div>
        <div class="form-group">
            {{ Form::label('hasRoadAccess','Accessed by road/car') }}
            {{ Form::radio('hasRoadAccess', '1',($utility[0]['hasRoadAccess']== '1') ? true : false) }} Yes
            {{ Form::radio('hasRoadAccess', '0',($utility[0]['hasRoadAccess']== '0') ? true : false) }} No
        </div>
        <div class="form-group">
            {{ Form::label('hasSand','Sandy beach') }}
            {{ Form::radio('hasSand', '1',($utility[0]['hasSand']== '1') ? true : false) }} Yes
            {{ Form::radio('hasSand', '0',($utility[0]['hasSand']== '0') ? true : false) }} No
        </div>
        <div class="form-group">
            {{ Form::label('hasParking','Parking Available') }}
            {{ Form::checkbox('hasFreeParking', '1',($utility[0]['hasFreeParking']== '1') ? true : false) }} Free
            {{ Form::checkbox('hasPaidParking', '1',($utility[0]['hasPaidParking']== '1') ? true : false) }} Paid
        </div>
        <div class="form-group">
            {{ Form::label('hasSunbed','Sunbeds Available') }}
            {{ Form::checkbox('hasFreeSunbed', '1',($utility[0]['hasFreeSunbed']== '1') ? true : false) }} Free
            {{ Form::checkbox('hasPaidSunbed', '1',($utility[0]['hasPaidSunbed']== '1') ? true : false) }} Paid
        </div>
        <div class="form-group">
            {{ Form::label('hasUmbrella','Umbrellas Available') }}
            {{ Form::checkbox('hasFreeUmbrella', '1',($utility[0]['hasFreeUmbrella']== '1') ? true : false) }} Free
            {{ Form::checkbox('hasPaidUmbrella', '1',($utility[0]['hasPaidUmbrella']== '1') ? true : false) }} Paid
        </div>
         <div class="form-group">
            {{ Form::hidden ('beach_id',$utility[0]['beach_id'], array('required'=>'true')) }}
        </div>
        {{ Form::button('Update utilities!', array('class'=>'btn btn-success')) }}
        {{ Form::close() }}
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <h3>{{ $beach['name'] }}</h3>
        <p>{{ $beach['description'] }}</p>
        <p>Check the comments section below!</p>
        <p>..or add your own reviews regarding {{ $beach['name'] }}</p>
    </div>
    
</div>

<hr>

<div class="row">
    <div class="row">
        <div class="col-md-3">
            <h3><span class="label label-info">Comments</span></h3>
        </div>
        
        <div class="col-md-3">
            <!-- Placeholder -->
       </div>
    </div>
    <div ng-controller="reviewController" class="row">
        <div ng-repeat='review in reviews' class="col-md-3">
            <blockquote>
                <p><span class="glyphicon glyphicon-search"></span>&nbsp; %% review.title %% (Rate: %% review.rate %% )</p>
                <footer> %% review.text %%</footer> 
                <footer> %% review.created_at %% </footer>
            </blockquote>
        </div>
    </div>
</div>
<hr>
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

@stop
