<nav class="navbar navbar-expand navbar-dark young-passion-gradient">

  <a class="navbar-brand" href="/"><i class="far fa-sticky-note mr-1"></i>Eat Have Fun</a>

  <ul class="navbar-nav ml-auto">
    @guest
    <li class="nav-item d-none d-sm-block">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
    </li>
    @endguest

    @guest
    <li class="nav-item d-none d-sm-block">
      <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest

    @auth
    <li class="nav-item d-none d-sm-block">
      <a class="nav-link" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
    </li>
    @endauth

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
      @guest
      <button class="dropdown-item" type="button"
                onclick="location.href='{{ route('register') }}'">
                ユーザー登録
        </button>
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route('login') }}'">
                ログイン
        </button>
        @endguest
    @auth
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route('articles.create') }}'">
          投稿する
        </button>
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route('users.show', ['name' => Auth::user()->name]) }}'">
          マイページ
        </button>
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
    @endauth
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{ route('logout') }}">
      @csrf
    </form>
    <!-- Dropdown -->
  </ul>

</nav>