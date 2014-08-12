@extends('layout.default')
@section('content')
<div class="row-fluid">
    <div class="col-md-8 col-md-offset-1 col-sm-12">
        <img src="/images/under_development.png" id="underdevelopment" class="img-responsive img-rounded hidden-xs" alt="under-development">
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
                <div class="box">
                    <div class="icon">
                        <div class="image"><span class="fa fa-info-circle btn-lg-not-bootstrap white"></span></div>
                        <div class="info">
                            <!--<h3 class="title">Tasks</h3>-->
                            <p>{{ $beachCount }} {{ trans('menu.registeredBeaches') }}!</p>
                            <div class="more">
                                <a href="/beach" title="{{ trans('menu.discover') }}"><i class="fa fa-plus"></i> {{ trans('menu.more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="space"></div>
                </div>
            </div>
            <div class="col-md-12 col-sm-6">
                <div class="box">
                    <div class="icon">
                        <div class="image"><span class="fa fa-comment-o btn-lg-not-bootstrap white"></span></div>
                        <div class="info">
                            <!--<h3 class="title">Mentions</h3>-->
                            <p>{{ $reviewCount }} {{ trans('menu.submittedReviews') }}!</p>
                            <div class="more">
                                <a href="/beach" title="{{ trans('menu.discover') }}"><i class="fa fa-plus"></i> {{ trans('menu.more') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="space"></div>
                </div>
            </div>

            <div class="col-md-12 col-sm-6">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form_hover ">
                            <p>
                                <!--<i class="fa fa-user" style="font-size: 147px;"></i>-->
                                <img src="{{ $randomBeach['imagePath'] }}">
                            </p>
                            <div class="header">
                                <!--<div class="blur"></div>-->
                                <div class="header-text">
                                    <div class="panel panel-success" style="height: 247px;">
                                        <div class="panel-heading">
                                            <h3 style="color: white;">{{ $randomBeach['name'] }}</h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                Registered on <b>{{ date_format(date_create($randomBeach['created_at']), 'd-m-Y')}}</b>
                                            </div>
                                            <div class="form-group">
                                                Review Count:<b>{{ $randomBeach['review_count'] }}</b>
                                            </div>
                                            <div class="form-group">
                                                Rating:<br />
                                                <?php
                                                $stars = floor($randomBeach['avg_rate']);
                                                for ($i = 0; $i < 5; $i++) {
                                                    if ($i < $stars) {
                                                        ?><i class="fa fa-star"></i><?php
                                                    } else {
                                                        ?><i class="fa fa-star-o"></i><?php
                                                    }
                                                }
                                                ?>
                                                <div class="form-group">
                                                    <a class="btn" href="/beach/{{ $randomBeach['slug'] }}" title="{{ $randomBeach['name'] }}">{{ trans('menu.more') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .form_hover {
                        padding: 0px;
                        position: relative;
                        overflow: hidden;
                        height: 240px;
                    }
                </style>
            </div>
        </div>
    </div>
</div>

@stop