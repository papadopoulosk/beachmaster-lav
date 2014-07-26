@extends('layout.default')
@section('content')
<div class="row-fluid">
    <div class="col-md-6 col-sm-12">
        <h1>Login</h1>
        {{ Form::open(array(
            'method'=>'post', 
            'url' => '/auth',
            'role'=>'form'
         )) }}
        <div class="form-group">
        {{ Form::text('username',null, array('class'=>'form-control','required'=>'true','placeholder'=>'Username *')) }}
        </div>
        <div class="form-group">
        {{ Form::password('password', array('class'=>'form-control','required'=>'true','placeholder'=>'Password *')) }}
        </div>
        <div class="checkbox">
            <label>
              <input type="checkbox"> Remember Me
            </label>
        </div>
        <div class="form-group">
        {{ Form::submit('Login', array('class'=>'btn btn-success')) }}
        </div>
        <div class="">
            <p><a>Forgot Password</a></p>
        </div>
        <div class="">
            <p>*:Required</p>
        </div>
        {{ Form::close() }}
    </div>    
</div>


@stop