<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">

  <a class="navbar-brand" href="{{ route('root') }}">Brand</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">User Dashboard<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
      </li>
    </ul>
 

    




    @if(Auth::guard('web')->user())
        <a href="{{ route('logout') }}">
          <button class="btn btn-outline-success">
            <small>User</small>-{{Auth::guard('web')->user()->name}} LogOut
          </button>
        </a>
        @if(Auth::guard('admin')->user())
          <a href="{{ route('admin.logout') }}">
            <button class="btn btn-outline-success">
              <small>Admin</small>-{{Auth::guard('admin')->user()->name}} LogOut
            </button>
          </a>
        @else
          <a href="{{ route('admin.root') }}">
            <button class="btn btn-outline-success">Admin LogIn</button>
          </a>
        @endif
    @else
        <a href="{{ route('root') }}">
          <button class="btn btn-outline-success">User LogIn</button>
        </a>
    @endif




  </div>

  </div>
</nav>