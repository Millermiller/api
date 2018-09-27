<nav id="sidr-left" style="left: -260px;position: fixed;">
    <ul>
        <li>
            <a href="/">Главная</a>
        </li>
        <li>
            <a href="/#langauges">Языки</a>
        </li>
        <li>
            <a href="<?= env('FORUM')?>">Форум</a>
        </li>
        <!--  <li>
              <a href="/downloads">Материалы</a>
          </li> -->
        <li>
            <a href="/blog">Статьи</a>
        </li>
        <?php if (!Auth::check()): ?>
        <li><a href="#login" class="fancybox">Вход</a></li>
        <li><a href="#registration" class="fancybox">Регистрация</a></li>
        <?php else: ?>
        <li><a href="/logout">Выход</a></li>
        <li>
            <a href="/cabinet">
                <?= Auth::user()->login ?>
                <div class="avatar-wrapper-small"><div class="avatar" style="background-image: url(<?= Auth::user()->avatar; ?>)"></div></div>
            </a>
        </li>
        <?php endif; ?>
        <?php if (Auth::check() && Auth::user()->_admin): ?>
        <li><a href="/admin">adminpanel</a></li>
        <?php endif; ?>
    </ul>
</nav>