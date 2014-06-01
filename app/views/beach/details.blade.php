@extends('layout.default')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="row">
            <img src="{{ $beach['imagePath'] }}" class="col-md-12">
        </div>
        <div class="row">

        </div>
    </div>
    
    <div class="col-md-8 jumbotron">
        <h3>{{ $beach['name'] }}</h3>
        <p>{{ $beach['description'] }}</p>
    </div>
    
    <div class="col-md-8">
        <p>Check the comments section below!</p>
        <p>..or add your own reviews regarding {{ $beach['name'] }}</p>
    </div>

</div>

<hr>

<div class="row">
    <h3><span class="label label-info">Comments</span></h3>
    @foreach($reviews as $key => $value)
    <div class="thumbnail col-md-3">
        <div class="">
            <h4 class="media-heading"><span class="glyphicon glyphicon-search"></span>&nbsp;{{ $value['title'] }}</h4>
            {{ $value['text'] }}
        </div>
    </div>
    @endforeach
</div>

<div class="row">
    {{ Form::model(new review) }}
        {{ Form::label('title','Title') }}
        {{ Form::text ('title') }}
        
        {{ Form::label('text','Text') }}
        {{ Form::text ('text') }}
        {{ Form::submit('Save!') }}
    {{ Form::close() }}    
</div>

@stop
