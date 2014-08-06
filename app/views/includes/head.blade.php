<meta charset="utf-8">
<meta name="description" content="Beach management system">
<meta name="author" content="Konstantinos Papadopoulos">
<meta name=viewport content="width=device-width, initial-scale=1">

<title>Beach Master</title>

<meta name="_token" content="{{ csrf_token() }}" />

<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">-->
{{ HTML::style('css/bootstrap.min.css') }}

<!-- Main CSS file for custom changes -->
{{ HTML::style('css/mainCSS.css') }}

<!-- Jquery Plugin -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

<!-- Google Maps Plugin-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
    
<!-- GMap3 plugin -->
{{ HTML::script('scripts/gmap3.min.js') }}

<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.20/angular.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.20/angular-animate.js"></script>

<!-- AngularUI for pagination and typehead (bindHtml, position) ONLY. -->
{{ HTML::script('scripts/ui-bootstrap-tpls-0.11.0-new.js') }}

<!-- Angular application file -->
{{ HTML::script('scripts/myangular.js') }}
