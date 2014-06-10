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
    <div class="row">
        <div class="col-md-3">
            <h3><span class="label label-info">Comments</span></h3>
        </div>

        <div class="col-md-3">
            <h3>
                <span class="label label-info">Rate</span>
                &nbsp;
                <a id="rateup"><span class="glyphicon glyphicon-thumbs-up"></span></a>
                &nbsp;
                <a id="ratedown"><span class="glyphicon glyphicon-thumbs-down"></span></a>
            </h3>
        </div>

        <div class="col-md-3">
            <!-- Placeholder -->
       </div>
    </div>
    <div class="row">
        @foreach($reviews as $key => $value)
        <div class="col-md-3">
            <blockquote>
                <p><span class="glyphicon glyphicon-search"></span>&nbsp;{{ $value['title'] }}</p>
                <footer>{{ $value['text'] }}</footer> 
                <footer>{{ date('m/d/y', strtotime($value['created_at']) ) }}</footer>
            </blockquote>
        </div>
        @endforeach
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4">
    {{ Form::open(array('method'=>'post', 'url' => 'review/add','role'=>'form')) }}
            
                @foreach($errors->all() as $message)
                    <p class="alert alert-warning">{{ $message }}</p>
                @endforeach
            
        <div class="form-group">
            {{ Form::text ('title',Input::old('title'), array('class'=>'form-control','placeholder'=>'Review Title','required'=>'true')) }}
        </div>
        <div class="form-group">
            {{ Form::textarea ('text',Input::old('text'), array('class'=>'form-control','placeholder'=>'Type here your review..','required'=>'true')) }}
        </div>
        {{ Form::hidden('beachId', $beach['id']) }}
        
        {{ Form::submit('Submit!', array('class'=>'btn btn-success')) }}
    {{ Form::close() }}    
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#rateup").click(function(){
            data = "beachId={{ $beach['id'] }}";
            $.ajax({
                url: "api/v1/rateup",
                type: "post",
                data: data,
                success: function(data){
                    alert(data);
                },
                error:function(){
                    alert("failure");
                }
            });
        })
    });
</script>

@stop
