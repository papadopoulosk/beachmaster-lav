@extends('layout.default')
@section('content')        
        @foreach($beaches as $key => $value)
        <p>{{ $value['name'] }} -- {{ $value['description'] }} -- {{ $value['rate'] }}</p>
        @endforeach
@stop