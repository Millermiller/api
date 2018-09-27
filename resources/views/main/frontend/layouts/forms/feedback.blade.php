<div id="feedback" style="display: none;">
    <form id="feedbackform" action="">
        {!! csrf_field() !!}
        <a class="closeModal" data-dismiss="modal">×</a>
        <div class="form-group bmd-form-group">
            <label for="name" class="bmd-label-floating control-label">Представьтесь:</label>
            <input id="name" class="form-control" type="text" required/>
        </div>
        <div class="form-group bmd-form-group">
            <label for="message" class="bmd-label-floating control-label">Ваше сообщение:</label>
            <textarea name="message" id="message" cols="50" rows="10" class="form-control"></textarea>
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn">Отправить</button>
        </div>
    </form>
</div>