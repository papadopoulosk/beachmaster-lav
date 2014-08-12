@extends('layout.default')
@section('content')
<div class="col-md-12 col-md-offset-3">
    <div class="row">

        <div class="col-md-6 col-sm-12">
            <div class="row text-center">
<!--                <div class="col-md-4 col-sm-12">
                    <button type="button" class="btn btn-primary btn-block">Facebook</button>
                </div>
                <div class="col-md-4 col-sm-12">
                    <button type="button" class="btn btn-info btn-block">Twitter</button>
                </div>-->
                <div class="col-md-4 col-md-offset-4 col-sm-12">
                    <a class="btn btn-danger btn-block" href="/auth/google">Google</a>
                </div>
            </div>
            <hr />
        </div>

    </div>

    <div class="row">
        <div class="col-md-6 col-sm-12">

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
</div>

@stop