@extends('main.frontend.layouts.index')

@section('content')

    <script src="{{ url('js/libs/vue.min.js') }}"></script>
    <link href="{{ url('css/swiper.min.css') }}" rel="stylesheet">
    <script src="{{ url('js/libs/swiper.min.js') }}"></script>
    <script src="{{ url('js/libs/vue-awesome-swiper.js') }}"></script>
    <script src="{{ url('js/libs/vue-radial-progress.min.js') }}"></script>
    <script src="{{ url('js/libs/vue-drag-drop.browser.js') }}"></script>
    <script src="{{ url('js/main.js') }}"></script>
    <script src="{{ url('js/text.js') }}"></script>
    <script src="{{ url('js/syns.js') }}"></script>
    <script src="{{ url('js/cards.js') }}"></script>
    <script src="{{ url('js/test.js') }}"></script>

    <div class=" parallax-window" data-parallax="scroll" data-image-src="/img/head-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message" style="color: rgb(255, 255, 255);">
                        <h1>Scandinaver</h1>
                        <p>
                            "Я изучаю исландский язык не для того, чтобы научиться политике, приобрести военные знания и
                            т. п.,<br/>
                            но для того, чтобы научиться образу мыслей мужа, для того, чтобы избавиться<br/>
                            от укоренившегося во мне с детства благодаря воспитанию духа убожества и рабства,<br/>
                            для того, чтобы закалить мысль и душу так, чтобы я мог без трепета идти навстречу
                            опасности<br/>
                            и чтобы моя душа предпочла скорее расстаться с телом,<br/>
                            чем отречься от того, в истинности и правоте чего она непоколебимо убеждена".<br/>
                            Rasmus Christian Rask
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('main.frontend.index.blocks.slider_block')
    @include('main.frontend.index.blocks.test_block')
    @include('main.frontend.index.blocks.puzzle_block')
    @include('main.frontend.index.blocks.text_block')
    @include('main.frontend.index.blocks.mobile_block')
    @include('main.frontend.index.blocks.languages_block')
    <div class="content-section-a" id="prices">
        <div class="container full-width" style="overflow: hidden;">
            @include('main.frontend.payment.pricelist')
        </div>
    </div>
    @if(!Auth::check())
        <div class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">

                    </div>
                    <div class="col-lg-12 text-center">
                        <a href="#registration" class="btn btn-default btn-lg fancybox">
                            <span class="network-name">Регистрация</span></a>
                        <a href="#loginmodal" class="btn btn-default btn-lg fancybox">
                            <span class="network-name">Вход</span></a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop