
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <!-- <a class="brand" href="#"></a> -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <div class="nav-collapse collapse">
        <ul class="nav">
          @foreach(array('Heim' => '/', 'FAQ' => '/faq') as $key => $v)
          <li @if (substr(URL::current(),strlen(Request::root())) === $v)
          class="active"
          @endif>
            <a href="{{$v}}">{{$key}}</a>
          </li>
          @endforeach
      </ul>
      <ul class="nav pull-right">
        @if(Auth::guest())
          @foreach(array('Skrá inn' => '/login', 'Nýskrá' => '/register') as $key => $v)
          <li @if (substr(URL::current(),strlen(Request::root())) === $v)
          class="active"
          @endif>
            <a href="{{$v}}">{{$key}}</a>
          </li>
          @endforeach
        @else
          @foreach(array(Auth::user()->name => '/profile', 'Skrá út' => '/logout') as $key => $v)
          <li @if (substr(URL::current(),strlen(Request::root())) === $v)
          class="active"
          @endif>
            <a href="{{$v}}">{{$key}}</a>
          </li>
          @endforeach
        @endif
      </ul>

  </div>
</div>
</div>
</div>