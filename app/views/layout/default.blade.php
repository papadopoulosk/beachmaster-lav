<!doctype html>
<html>
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
</body>
</html>
