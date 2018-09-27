<div id="login" style="display: none;">
    <form id="loginform" action="">
        {!! csrf_field() !!}
        <a class="closeModal" data-dismiss="modal"></a>
        <div class="form-group bmd-form-group">
            <label for="log" class="bmd-label-floating control-label">Логин/ email</label>
            <input id="log" name="login" class="form-control" type="text"/>
        </div>
        <div class="form-group bmd-form-group">
            <label for="pass" class="bmd-label-floating control-label">Пароль</label>
            <input id="pass" name="password" class="form-control" type="password"/>
        </div>
        <div class="form-group text-center">
            <div class="row no-margin">
                <button type="submit" class="btn">Вход</button>
            </div>
            <div class="row no-margin">
                <a id="restore" class="text-muted small text-center" href="#">Восстановить пароль</a>
            </div>
        </div>
    </form>
    <form id="remindform" action="" style="display:none">
        <a class="closeModal" data-dismiss="modal"></a>
        <div class="form-group bmd-form-group">
            <label for="remindlog" class="bmd-label-floating control-label">Email</label>
            <input id="remindlog" class="form-control" type="email" required/>
        </div>
        <div class="form-group text-center">
            <div class="row no-margin">
                <button type="submit" class="btn">Восстановить</button>
            </div>
        </div>
    </form>
</div>