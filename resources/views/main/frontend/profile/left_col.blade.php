<div class="col-md-3 col-xs-12 " style="border-right: 1px solid #eee;">
    <div class="row">
        <div class="avatar-wrapper-large center-block">
            <img src="{{ '/uploads/u/'.$user->photo}}" alt="">
                @if(!$user->photo)
                    <p>Загрузить изображение профиля</p>
                @endif

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="uploadPhoto" style="display: none">
                <form method="post" id="uploadPhotoForm" enctype="multipart/form-data">
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
            </ul>
        </div>
    </div>
</div>