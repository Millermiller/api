<nav class="navbar navbar-default" role="navigation">
    <div class="logo-wrapper">
        <a href="{{ route('frontend::home') }}">
            <div class="logo"></div>
        </a>
    </div>
    <div class="container">
        <div class="navbar-header pull-left">
            <a id="left-menu" href="#left-menu">
                <button type="button" class="navbar-toggle collapsed">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="">
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{ route('frontend::home') }}">Главная</a>
                </li>
                <li>
                    <a href="/#langauges">Языки</a>
                </li>
                <li>
                    <a href="{{ env('FORUM') }}">Форум</a>
                </li>
                <!--  <li>
                      <a href="/downloads">Материалы</a>
                  </li>
                  <li>
                      <a href="/blog">Блог</a>
                  </li> -->
                @if (!Auth::check())
                    <li>
                        <a href="#loginmodal" class="fancybox">Вход</a>
                    </li>
                    <li>
                        <a href="#registration" class="fancybox">Регистрация</a>
                    </li>
                @else
                    <li class="{{ request()->is('profile*') ? 'active' : '' }}">
                        <a href="{{ route('frontend::profile') }}"><?= Auth::user()->login ?></a>
                    </li>
                    <li class="avatar-wrapper-small">
                        <img src="<?= Auth::user()->avatar; ?>" alt="">
                    </li>
                    <li><a href="{{ route('frontend::logout') }}">Выход</a></li>
                @endif
                @if (Auth::check() && Auth::user()->isAdmin())
                    <li><a href="{{ route('backend::admin') }}">adminpanel</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>