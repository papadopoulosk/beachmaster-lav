<!doctype html>
<html ng-app="beachApp">
    <head>
        @include('includes.head')
    </head>
    <body>
        @include('includes.header')
        <div class="container">
            @if(Session::has('message'))
            <div class="row-fluid col-md-6">
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    {{ Session::get('message') }}
                </div>
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
    </body>
</html>
