
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
          {{
            Navbar::render(
              array(
                'Heim' => '/', 
                'FAQ' => '/faq'
              )
            )
          }}
      </ul>
      <ul class="nav pull-right">
        @if(Auth::guest())
          {{
            Navbar::render(
              array(
                'Skrá inn' => array(
                  'Skrá inn' => '/login',
                  'Endurstilla lykilorð' => '/forgot'
                ), 
                'Nýskrá' => '/register'
              )
            )
          }}
        @else
          @if(Auth::user()->hasRole('Admin'))
          {{
            Navbar::render(
              array(
                'Admin' => array(
                  'Tilkynningar' => '/admin/announcement',
                  'Notendur' => '/admin'
                )
              )
            )
          }}
          @endif
          {{
            Navbar::render(
              array(
                Auth::user()->name => '/profile', 
                'Skrá út' => '/logout'
              )
            )
          }} 
        @endif
      </ul>

  </div>
</div>
</div>
</div>