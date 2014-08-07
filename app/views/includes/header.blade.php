<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">{{ trans('menu.beachmasterBrand') }}</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navbar-collapse-1">
      <ul class="nav navbar-nav">
            <li {{ Request::is('beach') ? 'class="active"' : '' }}><a href="/beach">{{ trans('menu.discover') }}</a></li>
            <li {{ Request::is('beach/create') ? 'class="active"' : '' }}><a href="/beach/create">{{ trans('menu.add') }}</a></li>
<!--        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Add</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Login</a></li>
          </ul>
        </li>-->
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
        <li>
            <form class="navbar-form navbar-left" role="search" ng-controller="TypeaheadCtrl">
                <div class="form-group">
                    <input type="text" placeholder="{{ trans('menu.searchByName') }}" ng-model="selected" typeahead="name as name.name for name in names | filter:$viewValue | limitTo:8" class="form-control" typeahead-on-select="onSelect()">
                    <i ng-show="loadingLocations" class="glyphicon glyphicon-refresh"></i>
                </div>
            </form>
        </li>  
        <li {{ Request::is('about') ? 'class="active"' : '' }} ><a href="/about">{{ trans('menu.about') }}</a></li>
        <li {{ Request::is('contact') ? 'class="active"' : '' }}><a href="/contact">{{ trans('menu.contactUs') }}</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('menu.more') }}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class="disabled"><a href="#">{{ trans('menu.terms') }}</a></li>
            <li class="divider"></li>
            @if (Auth::check())
                <li class=""><a href="/admin">{{ trans('menu.dashboard') }}</a></li>
                <li class=""><a href="/logout">{{ trans('menu.logout') }}</a></li>
            @else
                <li class="disabled"><a href="#">{{ trans('menu.register') }}</a></li>
                <li class=""><a href="/login">{{ trans('menu.login') }}</a></li>
            @endif
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>