<div class="wrapper ">
  @include('layouts.backend.navbars.sidebar')
  <div class="main-panel">
    @include('layouts.backend.navbars.navs.auth')
    @yield('content')
    @include('layouts.backend.footers.auth')
  </div>
</div>