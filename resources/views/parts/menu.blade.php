<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @if(!auth()->user())
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/signup ') }}">サインアップ <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/login') }}">ログイン</a>
                </li>
                @elseif(auth()->user())
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="bookshelfDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            本棚
                              </a>
                        <div class="dropdown-menu" aria-labelledby="bookshelfDropdown">
                            <a class="dropdown-item" href="{{ url('/bookshelf') }}">本棚一覧</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/bookshelf/create') }}">本棚の作成</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="bookDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                                本
                                  </a>
                        <div class="dropdown-menu" aria-labelledby="bookDropdown">
                            <a class="dropdown-item" href="{{ url('/book') }}">本一覧</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/book/create') }}">本の作成</a>
                        </div>
                    </div>
                </li>
                @endif
            </ul>

            @if(auth()->user())
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    {{ auth()->user()->email }}
                  </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">マイページ</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('/logout') }}">ログアウト</a>
                </div>
            </div>
            @endif
        </div>
    </nav>
</header>
