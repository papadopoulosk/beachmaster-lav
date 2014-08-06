@extends('layout.default')
@section('content')
<div class="row-fluid">
    <div class="col-md-9 col-sm-12">
        <h1>BeachMaster</h1>
        <div class="jumbotron">
        
        <p class="label label-info">Under maintenance <span class="glyphicon glyphicon-wrench"></span></p>
        <hr>
        <p>We are undergoing some serious changes! Back online soon! :-)</p>
        </div>

        
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="row-fluid">
            @include('includes.sidebar')
        </div>
        
    </div>
</div>
@stop