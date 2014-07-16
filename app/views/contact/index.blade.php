@extends('layout.default')
@section('content')
<div class="">
        <h1>Contact BeachMaster Team!</h1>
        <p class="lead blog-description">...and we will get back to you!</p>
</div>
<div class="row-fluid">

    <div class="col-sm-8">
        {{ Form::open(array(
                    'method'=>'post', 
                    'url' => '/contact',
                    'role'=>'form'
                 )) }}

                 <div class="form-group">
                    {{ Form::label('name', 'Enter your name*') }}
                    {{ Form::text ('name',Input::old('name'), array('class'=>'form-control','required'=>'true')) }}
                </div>
                 <div class="form-group">
                    {{ Form::label('email', 'E-mail address*') }}
                    {{ Form::email ('email',Input::old('email'), array('class'=>'form-control','required'=>'true')) }}
                </div>         

                 <div class="form-group">
                    {{ Form::label('description', 'Subject*') }}
                    {{ Form::textarea ('description',Input::old('description'), array('class'=>'form-control','required'=>'true')) }}
                </div>
                 <p class="small">*: Required fields</p>
                 {{ Form::submit('Send!', array('class'=>'btn btn-success')) }}

        {{ Form::close() }}
    </div>
    <div class="col-sm-3 col-sm-offset-1">
      @include('includes.sidebar')
    </div>
</div>
@stop