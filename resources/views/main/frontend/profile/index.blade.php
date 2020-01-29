@extends('main.frontend.layouts.index')
@section('content')
    <section class="container panel" style="margin-top: 50px;margin-bottom: 50px;">
        <div class="row" style="height: 100%;">
            @include('main.frontend.profile.left_col')
            @yield('profile')
        </div>
    </section>
@stop