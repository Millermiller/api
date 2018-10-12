@extends('main.frontend.profile.index')
@section('profile')
    <div class="col-md-6 col-md-offset-1 col-xs-12">
        <div class="row">
            <div class="col-md-12">
                <div class="user_details">
                    <form method="post" action="{{route('frontend::profile-update')}}">
                        {{ csrf_field() }}
                        <fieldset>
                            <h4>Настройки профиля:</h4>
                            <div class="form-group bmd-form-group
                                        @if($user->email) is-filled @endif
                                        @if ($errors->has('email'))has-error @endif">
                                <label for="email" class="bmd-label-floating control-label">Email:</label>
                                <input class="form-control"
                                       id="email"
                                       name="email"
                                       type="text"
                                       value="{{$user->email}}"/>
                                @if ($errors->has('email'))
                                    <p class="help-block">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                            <div class="form-group bmd-form-group
                                        @if($user->login) is-filled @endif
                                        @if ($errors->has('login'))has-error @endif">
                                <label for="log" class="bmd-label-floating control-label">Login:</label>
                                <input class="form-control" id="log" type="text" name="login"
                                       value="{{$user->login}}"/>
                                @if ($errors->has('login'))
                                    <p class="help-block">{{ $errors->first('login') }}</p>
                                @endif
                            </div>

                            <h4>Изменение пароля:</h4>
                            <div class="form-group bmd-form-group @if ($errors->has('password'))has-error @endif">
                                <label for="password" class="bmd-label-floating control-label">Новый пароль:</label>
                                <input class="form-control col-md-6" id="password" name="password" type="password"
                                       autocomplete="false" readonly onfocus="this.removeAttribute('readonly')"/>
                                @if ($errors->has('password'))
                                    <p class="help-block">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <div class="form-group bmd-form-group @if ($errors->has('password'))has-error @endif">
                                <label for="password_confirmation" class="bmd-label-floating control-label">Повторить
                                    пароль:</label>
                                <input class="form-control col-md-6" id="password_confirmation"
                                       name="password_confirmation" type="password"/>
                                @if ($errors->has('password'))
                                    <p class="help-block">{{ $errors->first('password') }}</p>
                                @endif
                            </div>
                            <button id="lk-update" class="col-md-6 btn btn-success no-margin">Сохранить</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop