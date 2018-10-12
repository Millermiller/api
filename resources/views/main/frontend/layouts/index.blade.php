<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>{!! Meta::get('title') !!}</title>
    <meta name="csrf-token" content="{!! csrf_token() !!}" />

    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Julius+Sans+One">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic">

    <link href="{{ url('css/style.css') }}" rel="stylesheet">
    <script src="{{ url('js/libs.min.js') }}"></script>
    <script src="{{ url('js/script.js') }}"></script>
</head>
<body>
@include('main.frontend.layouts.navigation_mobile')
<div id="panel">
    @include('main.frontend.layouts.navigation')

    @include('main.frontend.layouts.flash')

    @yield('content')

    @include('main.frontend.layouts.footer')
</div>

@include('main.frontend.layouts.forms.login')

@include('main.frontend.layouts.forms.registration')

@include('main.frontend.layouts.forms.feedback')
<script>
    $(document).ready(function () {

        $('#remindform').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: '/remind',
                type: 'post',
                data: {email: $('#remindlog').val()},
                dataType: 'json',
                success: function (data) {
                    toastr[(data.success === true) ? 'success' : 'error'](data.msg);
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
                    $.fancybox.close();
                }
            })
        });

        $('#feedbackform').on('submit', function(e){

            e.preventDefault();

            let name = $('#name').val()
            /* var contact = $('#contact').val();*/
            let message = $('#message').val()

            $.ajax({
                url: '/ajaxFeedback',
                type: 'post',
                data: {name: name,/* contact:contact,*/ message:message},
                dataType: 'json',
                success: function(data){
                    toastr[(data.success === true) ? 'success' : 'error'](data.msg);
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
                    $.fancybox.close();
                }
            })
        })
    });
</script>
</body>
</html>
