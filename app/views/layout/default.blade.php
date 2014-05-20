<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
@include('includes.header')
<div class="container">
	<div id="main" class="row">
		<!-- main content -->
		<div id="content" class="col-md-8">
			@yield('content')
		</div>

	</div>

	<footer class="row">
		@include('includes.footer')
	</footer>

</div>
</body>
</html>
