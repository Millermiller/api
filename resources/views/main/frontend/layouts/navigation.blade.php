<nav class="navbar navbar-default" role="navigation">
    <div class="logo-wrapper">
        <a href="{{ route('frontend::home') }}">
            <div class="logo"></div>
        </a>
    </div>
    <div class="container">
        <div class="js-menu-show-wrapper hidden-lg">
            <button class="js-menu-show header__menu-toggle">
                <i class="ion ion-android-menu"></i>
            </button>
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
                    <a href="/#prices">Цены</a>
                </li>
                <li>
                    <a href="{{ config('app.FORUM') }}">Форум</a>
                </li>
                <?php /* <li>
                      <a href="/downloads">Материалы</a>
                  </li>
                  <li>
                      <a href="/blog">Блог</a>
                  </li> */?>
                @if (!Auth::check())
                    <li>
                        <a href="#loginmodal" class="fancybox">Вход</a>
                    </li>
                    <li>
                        <a href="#registration" class="fancybox">Регистрация</a>
                    </li>
                @else
                    <li class="{{ request()->is('profile*') ? 'active' : '' }}">
                        <a href="{{ route('frontend::profile') }}"><?= Auth::user()->getLogin() ?></a>
                    </li>
                    <li class="avatar-wrapper-small">
                        <img src="<?= Auth::user()->getAvatar(); ?>" alt="">
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