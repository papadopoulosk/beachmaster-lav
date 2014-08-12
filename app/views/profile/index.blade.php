@extends('layout.default')
@section('content')

<div class="row">
    <h1>Profile</h1>
    <div class="col-md-12">
        <div class="col-md-2 col-sm-2 col-xs-6">
            <img src="{{ $user['image'] }}" alt="profile image" class="img-rounded img-responsive">
            <p>{{ $user['name'] }}</p>
            <p>Joined at {{ $user['created_at'] }}</p>
        </div>
        <div class="col-md-5">
            <h2>Recent Activity</h2>
            <div class="row">
                <h3>Comments</h3>
                @foreach ($information['reviews'] as $review)
                <p>{{ $review['text'] }}</p>
                @endforeach
            </div>
            <div class="row">
                <h3>Images</h3>
                @foreach ($information['images'] as $image)
                <p>{{ $image['imagePath'] }}</p>
                @endforeach
            </div>
        </div>
        <div class="col-md-5">
            <h2>Beaches</h2>
            @foreach ($information['beaches'] as $beach)
            <p>{{ $beach['name'] }} - {{ $beach['created_at'] }}</p>
            @endforeach
        </div>
    </div>
</div>

@stop
