<!doctype html>
<html ng-app="beachApp">
<head>
    @include('includes.head')
</head>
<body>
@include('includes.header')
<div class="container">
        @if(Session::has('message'))
            <div class="row-fluid col-md-12">
                <p class="alert alert-warning col-md-6">{{ Session::get('message') }}</p>
            </div>
        @endif
        
	<div id="main" class="row-fluid col-md-12">
	<!-- main content -->
	@yield('content')
	</div>

	<div class="row-fluid col-md-12">
	@include('includes.footer')
	</div>

</div>

<!-- AngularJS Main file -->
{{ HTML::script('scripts/angular.min.js') }}
<!--{{ HTML::script('scripts/ui-bootstrap.js') }}-->

<!-- Angular application file -->
{{ HTML::script('scripts/myangular.js') }}

</body>
</html>
