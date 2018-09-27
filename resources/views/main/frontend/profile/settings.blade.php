@extends('main.frontend.profile.index')
@section('profile')
    <div class="col-md-6 col-md-offset-1 col-xs-12">
        <div class="row">
            <div class="col-md-12">
                <div class="user_details">
                    <form method="post" action="/cabinet/update">
                        <div class="form-group row">
                            <label for="lk-email" class="control-label">Email: (используется для входа на сайт)</label>
                            <input class="form-control" id="lk-email" name="lk-email" type="text"
                                   value="{{$user->email}}"/>
                        </div>
                        <div class="form-group row">
                            <label for="lk-login" class="control-label">Login: (можно указывать вместо email при
                                входе)</label>
                            <input class="form-control" id="lk-login" type="text" name="lk-login"
                                   value="{{$user->login}}"/>
                        </div>
                        <h4>Изменение пароля:</h4>
                        <div class="form-group row">
                            <label for="lk-pass" class="control-label">Новый пароль:</label>
                            <input class="form-control hidden" type="password"/>
                            <input class="form-control col-md-6" id="lk-pass" name="pass" type="password"/>
                        </div>
                        <div class="form-group row">
                            <label for="lk-pass-repeat" class="control-label">Повторить пароль:</label>
                            <input class="form-control col-md-6" id="lk-pass-repeat" name="pass-repeat"
                                   type="password"/>
                        </div>
                        <button id="lk-update" class="col-md-6 btn btn-success no-margin">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop