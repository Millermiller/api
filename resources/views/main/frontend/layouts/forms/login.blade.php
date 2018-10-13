<div id="loginmodal" style="display: none;">
    {!! Form::open(['id' => 'loginform']) !!}
        {!! csrf_field() !!}
        <a class="closeModal" data-dismiss="modal"></a>
        <div class="form-group bmd-form-group">
            {!! Form::label('login', 'Логин/ email', ['class'=> 'bmd-label-floating control-label']) !!}
            {!! Form::text('login', '', ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group bmd-form-group">
            {!! Form::label('password', 'Пароль', ['class'=> 'bmd-label-floating control-label']) !!}
            {!! Form::password('password', ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group text-center">
            <div class="row no-margin">
                {!! Form::submit('Вход', ['class' => 'btn']) !!}
            </div>
            <div class="row no-margin">
                <a id="restore" class="text-muted small text-center" href="#">Восстановить пароль</a>
            </div>
        </div>
    {!! Form::close() !!}
    {!! Form::open(['id' => 'remindform', 'style' => 'display:none', 'route' => 'restore']) !!}
        <a class="closeModal" data-dismiss="modal"></a>
        <div class="form-group bmd-form-group">
            {!! Form::label('email', 'Email', ['class'=> 'bmd-label-floating control-label']) !!}
            {!! Form::email('email', '', ['class'=> 'form-control']) !!}
        </div>
        <div class="form-group text-center">
            <div class="row no-margin">
                {!! Form::submit('Восстановить', ['class' => 'btn']) !!}
            </div>
        </div>
    {!! Form::close() !!}
</div>