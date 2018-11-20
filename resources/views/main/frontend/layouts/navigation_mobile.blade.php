<aside class="js-side-nav side-nav">
    <nav class="js-side-nav__container side-nav__container">
        <button class="js-menu-hide side-nav__hide">
            <i class="ion ion-android-close"></i>
        </button>

        <?php /*<header class="side-nav__header">
           <div  class="avatar-wrapper-small">
               @if (Auth::check())
                   <img src="<?= Auth::user()->avatar; ?>" alt="">
               @else
                    <!-- -->
               @endif
           </div>
        </header> */?>

        <ul class="side-nav__content">
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
                <a href="{{ env('FORUM') }}">Форум</a>
            </li>
            <?php /*  <li>
                     <a href="/downloads">Материалы</a>
                 </li>
                 <li>
                     <a href="/blog">Блог</a>
                 </li> */?>
            @if (!Auth::check())
                <li>
                    <a href="#loginmodal" class="fancybox hidesidebar">Вход</a>
                </li>
                <li>
                    <a href="#registration" class="fancybox hidesidebar">Регистрация</a>
                </li>
            @else
                <li class="{{ request()->is('profile*') ? 'active' : '' }}">
                    <a href="{{ route('frontend::profile') }}"><?= Auth::user()->login ?></a>
                </li>
                <li><a href="{{ route('frontend::logout') }}">Выход</a></li>
            @endif
            @if (Auth::check() && Auth::user()->isAdmin())
                <li><a href="{{ route('backend::admin') }}">adminpanel</a></li>
            @endif
        </ul>
    </nav>
</aside>