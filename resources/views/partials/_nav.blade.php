<!-- Bootstrap navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Laravel Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="nav navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('/') ? "active" : "" }}" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('blog') ? "active" : "" }}" href="/blog">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('about') ? "active" : "" }}" href="/about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ Request::is('contact') ? "active" : "" }}" href="/contact">Contact</a>
      </li>
    </ul>

    <ul class="nav navbar-nav">

    @if (Auth::check())

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Hello {{ Auth::user()->name }} {{-- gets the current user information from the database --}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{ route('posts.index') }}">Posts</a>
          <a class="dropdown-item" href="{{ route('categories.index') }}">Categories</a>
          <a class="dropdown-item" href="{{ route('tags.index') }}">Tags</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
        </div>
      </li>

    @else

      <a href="{{ route('login') }}" class="btn btn-default">Login</a>

    @endif
      
    </ul>
  </div>
</nav>