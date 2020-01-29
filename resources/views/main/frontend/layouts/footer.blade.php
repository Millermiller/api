<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <ul class="list-inline">
                    <!--
                    <li>
                        <a href="#home">Instagram</a>
                    </li>
                    <li class="footer-menu-divider">&sdot;</li>
                    -->
                    <li>
                        <a href="https://vk.com/scandinaver" target="_blank">VK</a>
                    </li>
                    <li class="footer-menu-divider">&sdot;</li>
                    <!--
                    <li>
                        <a href="#feedback">twitter</a>
                    </li>
                    <li class="footer-menu-divider">&sdot;</li>
                     -->
                    <li>
                        <a href="#feedback" class="fancybox">Письмо администрации</a>
                    </li>
                    <li class="footer-menu-divider">&sdot;</li>
                </ul>
                <p class="copyright text-muted small">Copyright &copy; Scandinaver <?= \Carbon\Carbon::now()->year?> | All Rights Reserved | support@scandinaver.org</p>
            </div>
            <div class="col-lg-4 text-center icon-block">
                <div class="row">
                    <div class="col-md-3 col-md-offset-3">
                        <img style="height: 40px;padding: 5px;" src="{{url('/img/ivona_tts_amzn.png')}}">
                    </div>
                    <div class="col-md-3 text-center">
                        <img style="height: 40px;padding: 5px;" src="{{url('/img/forvo-logo.png')}}">
                    </div>
                    <div class="col-md-3">
                        <a href="https://play.google.com/store/apps/details?id=ru.scandinaver" target="_blank">
                            <img style="height: 40px;" src="{{url('/img/google-play-badge.png')}}">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>