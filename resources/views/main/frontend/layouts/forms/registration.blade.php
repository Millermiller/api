<div id="registration" style="display: none;">
    <form id="registrationform" method="post">
        <a class="closeModal" data-dismiss="modal"></a>
        {!! csrf_field() !!}
        <fieldset>
            <legend class="text-center">Halló!</legend>
            <div class="form-group bmd-form-group">
                <label for="reg-login" class="bmd-label-floating control-label">Login</label>
                <input id="reg-login" class="form-control" name="login" type="text"/>
                <p class="help-block"></p>
            </div>
            <div class="form-group bmd-form-group">
                <label for="reg-email" class="bmd-label-floating control-label">Email</label>
                <input id="reg-email" class="form-control" type="text" name="email"/>
                <p class="help-block"></p>
            </div>
            <div class="form-group bmd-form-group">
                <label for="pass1" class="bmd-label-floating control-label">Пароль</label>
                <input id="pass1" class="form-control" type="password" name="password" />
                <p class="help-block"></p>
            </div>
            <div class="form-group bmd-form-group">
                <label for="pass2" class="bmd-label-floating control-label">Повторите пароль</label>
                <input id="pass2" class="form-control" type="password" name="password_confirmation"/>
                <p class="help-block"></p>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Регистрация</button>
            </div>
        </fieldset>
    </form>
</div>