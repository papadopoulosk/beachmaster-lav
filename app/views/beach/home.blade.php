@extends('layout.default')
@section('content')
<div class="row">
    <div id="map" class="col-md-8 col-md-offset-1"></div>    
</div>

<script type="text/javascript">
      $(function(){
          $("#map").gmap3();
      });
</script>


<div class="row">
<hr>

    <!-- Template for Angular view -->
    <div class="col-xs-2">
        <input type="text" class="form-control" placeholder="Search for beaches" ng-model="beachFilter">
    </div>
</div>

<div class="row">
<hr>
    
    <div ng-controller="beachController">
        <div ng-repeat='beach in beaches | filter:beachFilter' class="media col-md-4">
            <a class="pull-left" href="details/%%beach.id%%">
              <img src="http://lorempixel.com/75/75/nature/" class="media-object">
            </a>
            <div class="media-body">
              <h4 class="media-heading">%%beach.name%%</h4>
              %%beach.description%%
            </div>
            <p><a href="details/%%beach.id%%" class="btn btn-default" role="button">Details</a></p>
        </div>        
    </div>
    
    
<!-- Template for regular view
    @foreach($beaches as $key => $value)
        <div class="media col-md-4">
            <a class="pull-left" href="{{URL::to('details/'.$value['id'])}}">
              <img src="http://lorempixel.com/75/75/nature/" class="media-object">
            </a>
            <div class="media-body">
              <h4 class="media-heading">{{ $value['name'] }}</h4>
              {{ $value['description'] }}
            </div>
            <p><a href="{{URL::to('details/'.$value['id'])}}" class="btn btn-default" role="button">Details</a></p>
        </div>
    @endforeach    
-->    
</div>
@stop
