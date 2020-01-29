<html>
<head>
    <title>Восстановление пароля</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <script src="/application/assets/js/jquery-1.11.21.min.js"></script>
    <script src="/application/assets/js/bootstrap.min.js"></script>
    <link href="/application/assets/css/bootstrap.css" rel="stylesheet">
    <link href="/application/assets/css/bootstrap-material-design.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/application/assets/css/landing-page.css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/icon?family=Material+Icons">
    <script src="/application/assets/js/material.min.js"></script>
    <script src="/application/assets/js/ripples.min.js"></script>
    <script src="/application/assets/js/textChange.js"></script>
    <script async src="/application/assets/js/lib/toastr/toastr.min.js"></script>
    <link rel="stylesheet" href="/application/assets/js/lib/toastr/toastr.min.css"/>
</head>
<body style='background: #505D6E url("/application/assets/img/86491.jpg") no-repeat fixed center center / cover;'>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12">

                <form name="forgot" class="no-margin" action="" method="post">
                    <fieldset>
                        <legend class="text-center">
                            Восстановление пароля
                        </legend>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group no-margin">
                                <label for="pwd" class="col-md-2 control-label">Введите новый пароль</label>
                                <div class="col-md-10">
                                    <input id="pwd" type="password" name="pwd" class="form-control" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group no-margin">
                                <label for="pwd2" class="col-md-2 control-label">Повторите новый пароль</label>
                                <div class="col-md-10">
                                    <input id="pwd2" type="password" name="pwd2" class="form-control" autocomplete="off">
                                </div>
                                <i data-for="pwd2" class="material-icons icon-done">done</i>
                                <i data-for="pwd2" class="material-icons icon-warning">warning</i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-actions text-center">
                                <button type="submit" name='remind' value="1" class="btn btn-raised btn-primary">
                                    <span class="small-circle"><i class="fa fa-caret-right"></i></span>
                                    <small>Отправить</small>
                                </button>
                            </div>
                        </div>
                    </div>
                    </fieldset>
                    <input id="uid" type="hidden" name="uid" value="<?= $this->data->uid ?>">
            </form>

    </div>
</div>
<script>
    $(function () {
        $.material.init();

        $('#pwd2').on('textchange', function(){
            var orig = $('#pwd').val();
            var repeat = $('#pwd2').val();
            if(orig == repeat){
                $('i[data-for=pwd2].icon-warning').hide();
                $('i[data-for=pwd2].icon-done').show();
            }
            else{
                $('i[data-for=pwd2].icon-warning').show();
                $('i[data-for=pwd2].icon-done').hide();
            }
        });

        $('form').on('submit', function () {
            var pass1 = $('#pwd').val();
            var pass2 = $('#pwd2').val();
            var uid = $('#uid').val();

            if (pass1 != pass2 || pass1 == '') {
                toastr['error']('Пароли не совпадают');
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "10",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "linear",
                    "hideEasing": "linear",
                    "showMethod": "slideDown",
                    "hideMethod": "fadeOut"
                };
            }
            else {
                $.ajax({
                    url: '/remind/ajaxSetNewPass',
                    type: 'post',
                    data: ({pass: pass1, uid: uid}),
                    dataType: 'json',
                    success: function (data) {
                        toastr[(data.success == true)? 'success' : 'error'](data.msg);
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-bottom-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "10",
                            "hideDuration": "1000",
                            "timeOut": "999999",
                            "extendedTimeOut": "999999",
                            "showEasing": "linear",
                            "hideEasing": "linear",
                            "showMethod": "slideDown",
                            "hideMethod": "fadeOut"
                        };
                    }
                })
            }
            return false;
        })
    });
</script>
</body>
</html>