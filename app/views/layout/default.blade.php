<!doctype html>
<html ng-app="beachApp">
<head>
    @include('includes.head')
</head>
<body>
@include('includes.header')
<div class="container">
        @if(Session::has('message'))
            <p class="alert alert-warning">{{ Session::get('message') }}</p>
        @endif
        
	<div id="main" class="row col-md-12">
	<!-- main content -->
	@yield('content')
	</div>

	<div class="row col-md-12">
	@include('includes.footer')
	</div>

</div>

<!-- AngularJS Main file -->
{{ HTML::script('scripts/angular.min.js') }}

<!-- Angular application file -->
{{ HTML::script('scripts/myangular.js') }}

</body>
</html>
