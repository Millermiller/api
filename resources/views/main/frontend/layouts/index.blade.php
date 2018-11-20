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
<div id="scroller">
    <i class="ion ion-ios-arrow-up"></i>
</div>
<script src="{{ url('js/libs/side-nav.js') }}"></script>
</body>
</html>
