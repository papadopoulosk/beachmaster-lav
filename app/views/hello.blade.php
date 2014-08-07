@extends('layout.default')
@section('content')
<div class="row-fluid">
    <div class="col-md-8 col-md-offset-1 col-sm-12">
        <h1>{{ trans('menu.beachmasterBrand') }}</h1>
        <img src="/images/FirstPage.png" class="img-responsive img-rounded img-thumbnail" alt="description">
    </div>
    <div class="col-md-3 col-sm-12">
        <div class="row-fluid">
            @include('includes.sidebar')
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <img class="img-rounded" src="/images/beach-chair-icon.png" alt="Generic placeholder image" style="width: 140px; height: 140px;">
                <p>{{ $beachCount }} {{ trans('menu.registeredBeaches') }}!</p>
            </div>
            <div class="col-md-12 col-sm-6">
                <img class="img-rounded" src="/images/review-icon.png" alt="Generic placeholder image" style="width: 140px; height: 140px;">
                <p>{{ $reviewCount }} {{ trans('menu.submittedReviews') }}!</p>
            </div>
        </div>
        <p><a class="btn btn-info" href="/beach" role="button">{{ trans('menu.more') }} »</a></p>
    </div>
</div>
@stop