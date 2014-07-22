@extends('layout.default')
@section('content')
<div class="row">
    <div class="col-sm-8">
        <h1>BeachMaster</h1>
            <img src="/images/FirstPage.png" class="img-responsive img-rounded img-thumbnail" alt="description">
    </div>
    <div class="col-sm-3 col-sm-offset-1">
          @include('includes.sidebar')
    </div>
</div>
@stop