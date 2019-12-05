<div class="col-md-3 col-xs-12 " style="border-right: 1px solid #eee;">
    <div class="row">
        <div class="avatar-wrapper-large center-block" style="position: relative;">
            <img src="{{ Auth::user()->getAvatar() }}" alt="">
                @if(!$user->hasPhoto())
                    <p>Загрузить изображение профиля</p>
                @endif
            <div class="el-loading-mask" style="display: none">
                <div class="el-loading-spinner">
                    <svg viewBox="25 25 50 50" class="circular">
                        <circle cx="50" cy="50" r="20" fill="none" class="path"></circle>
                    </svg><!---->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="uploadPhoto" style="display: none">
                <form method="post" id="uploadPhotoForm" enctype="multipart/form-data" style="margin-bottom: 20px;">
                    {{ csrf_field() }}
                    <fieldset>
                        <div class="form-group">
                            <div class="col-md-10">
                                <input id="inputFile" multiple="" type="file" name="photo">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="inputFile" class="col-md-12  btn btn-success no-margin">Выбрать (до 2mb)</label>
                            <button class=" col-md-12 btn btn-success no-margin">Сохранить</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <ul class="profilemenu">
                <li class="{{ request()->is('profile') ? 'active' : '' }}">
                    <a href="{{ route('frontend::profile') }}">
                        <i class="ion ion-person"></i>Профиль
                    </a>
                </li>
                <li class="{{ request()->is('profile/settings') ? 'active' : '' }}">
                    <a href="{{ route('frontend::profile-settings') }}">
                        <i class="ion ion-settings"></i>Настройки
                    </a>
                </li>
                <li class="{{ request()->is('profile/log') ? 'active' : '' }}">
                    <a href="{{ route('frontend::profile-log') }}">
                        <i class="ion  ion-ios-time-outline"></i>Активность
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>