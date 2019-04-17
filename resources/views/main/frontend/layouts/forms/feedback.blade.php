<div id="feedback" style="display: none;position: relative;">
    {!! Form::open(['id' => 'feedbackform']) !!}
        <a class="closeModal" data-dismiss="modal"></a>
        <div class="form-group bmd-form-group">
            {!! Form::label('name', 'Представьтесь:', ['class'=> 'bmd-label-floating control-label']) !!}
            {!! Form::text('name', '', ['class'=> 'form-control']) !!}
            <p class="help-block"></p>
        </div>
        <div class="form-group bmd-form-group">
            {!! Form::label('message', 'Ваше сообщение:', ['class'=> 'bmd-label-floating control-label']) !!}
            {!! Form::textarea('message', '', ['class'=> 'form-control']) !!}
            <p class="help-block"></p>
        </div>
        <div class="form-group text-center">
            {!! Form::submit('Отправить', ['class' => 'btn']) !!}
        </div>
    {!! Form::close() !!}
    <div class="el-loading-mask" style="display: none">
        <div class="el-loading-spinner">
            <svg viewBox="25 25 50 50" class="circular">
                <circle cx="50" cy="50" r="20" fill="none" class="path"></circle>
            </svg><!---->
        </div>
    </div>
</div>