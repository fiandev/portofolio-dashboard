<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky">
    <h6 class="sidebar-heading d-flex justify-content-start gap-2 align-items-center px-3 mt-4 mb-2 text-muted">
        Menu
      </h6>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is("dashboard") ? "active" : ""}}" aria-current="page" href="/dashboard/">
          <span class="fa fa-home"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is("user/*") ? "active" : ""}}" aria-current="page" href="{{ route('user.account') }}">
          <span class="far fa-user"></span>
          Profile
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is("skills*") ? "active" : ""}}" aria-current="page" href="{{ url('/skills') }}">
          <span class="fa fa-code-merge"></span>
          Skills
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is("links*") ? "active" : ""}}" aria-current="page" href="{{ url('/links') }}">
          <span class="fa fa-link"></span>
          links
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is("apikey*") ? "active" : ""}}" aria-current="page" href="{{ url('/apikey') }}">
          <span class="fa fa-key"></span>
          apikey
        </a>
      </li>
       <li class="nav-item">
        <form class="nav-link" action="{{ url('/logout/') }}" method="post" accept-charset="utf-8">
          @csrf
          <button type="submit" class="p-0 border-0 bg-light">
            <i class="fa-solid fa-right-from-bracket"></i>
            logout
          </button>
        </form>
      </li>
    </ul>
  </div>
</nav>