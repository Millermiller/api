@extends('main.frontend.layouts.index')

@section('content')

    <script src="{{ url('js/libs/vue.min.js') }}"></script>
    <link href="{{ url('css/swiper.min.css') }}" rel="stylesheet">
    <script src="{{ url('js/libs/swiper.min.js') }}"></script>
    <script src="{{ url('js/libs/vue-awesome-swiper.js') }}"></script>
    <script src="{{ url('js/libs/progress.js') }}"></script>
    <script src="{{ url('js/libs/vue-radial-progress.min.js') }}"></script>
    <script src="{{ url('js/main.js') }}"></script>
    <script src="{{ url('js/text.js') }}"></script>
    <script src="{{ url('js/syns.js') }}"></script>

<div class=" parallax-window"  data-parallax="scroll" data-image-src="/img/head-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message" style="color: rgb(255, 255, 255);">
                    <h1>Scandinaver</h1>
                    <p>
                        "Я изучаю исландский язык не для того, чтобы научиться политике, приобрести военные знания и т. п.,<br/>
                        но для того, чтобы научиться образу мыслей мужа, для того, чтобы избавиться<br/>
                        от укоренившегося во мне с детства благодаря воспитанию духа убожества и рабства,<br/>
                        для того, чтобы закалить мысль и душу так, чтобы я мог без трепета идти навстречу опасности<br/>
                        и чтобы моя душа предпочла скорее расстаться с телом,<br/>
                        чем отречься от того, в истинности и правоте чего она непоколебимо убеждена".<br/>
                        Rasmus Christian Rask
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">Lorem ipsum dolor sit amet</h2>
                <p class="lead">Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit. Donec id lectus sit amet felis ultrices eleifend.
                    Suspendisse accumsan mauris a sem ultricies faucibus. Cras pharetra metus nec tempor interdum.
                    Proin tristique porta ultricies. Cras et sollicitudin nulla.
                    Pellentesque consequat nisl nec felis rutrum, sit amet dictum ligula iaculis.
                    Praesent ut dolor pulvinar mauris sodales egestas in eu ligula. </p>
            </div>
            <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                <div id="slider_view">
                    <swiper ref="awesomeSwiperA" :options="swiperOptionA">
                        <!-- slides -->
                        <swiper-slide v-for="(card, index) in cards" :key="index">
                            <div class="slide">
                                <p class="word">@{{card.word}}</p>
                                <template v-if="!card.nocontrols">
                                    <div :class="['translate-area', 'pointer']"  @click="showTranslate(index)">
                                        <template v-if="card.show">
                                            <p class="slide-value">@{{card.value}}</p>
                                            <div class="example-area">
                                                <template v-for="example in card.examples">
                                                    <p v-html="example.text" class="example-text"></p>
                                                    <p v-html="example.value" class="example-value"></p>
                                                </template>
                                                <p v-if="card.creator" :class="['danger', 'text-right', 'small']">
                                                    Добавлено: @{{card.creator}}
                                                </p>
                                            </div>
                                        </template>
                                        <i v-else class="ion-help"></i>
                                    </div>
                                    <audio :src="card.audio" :id="card.player" preload="none" :ref="card.player"></audio>
                                    <i :class="['ion favourite-button pointer', card.favourite ? activeClass : defaultClass]" @click="favourite(index)"></i>
                                    <i :class="['ion-ios-volume-high', 'ion', 'pointer']"  @click="play(card.player)"></i>
                                </template>
                            </div>
                        </swiper-slide>
                        <!-- Optional controls -->
                        <div class="swiper-pagination"  slot="pagination"></div>
                        <div class="swiper-button-prev" slot="button-prev"></div>
                        <div class="swiper-button-next" slot="button-next"></div>
                    </swiper>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-section-b">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">Lorem ipsum dolor sit amet</h2>
                <p class="lead">Sed vel mi ac felis aliquam lobortis.
                    Vivamus iaculis mauris faucibus tortor lobortis tempor.
                    Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                    Aenean sit amet placerat neque, in faucibus turpis. Sed sagittis eleifend lacinia.
                    Nam ut commodo velit, sit amet rutrum nulla. Fusce malesuada enim arcu, et vehicula nibh commodo vel.
                    Vestibulum tristique eros risus, eu laoreet lectus fringilla ac.</p>
            </div>
            <div class="col-lg-5 col-sm-pull-6  col-sm-6">
               <div id="test_view">

                   <div slot="header">
                       <vue-progress-bar key="test"></vue-progress-bar>
                       <h3 style="height: 76px;" class="text-center" v-if="question.word">@{{question.word}}
                           <hr></h3>
                       <template v-else>
                           <radial-progress-bar :diameter="300"
                                                :completed-steps="result"
                                                start-color="#20a0ff"
                                                stop-color="#20a0ff"
                                                inner-stroke-color="#eaeaea"
                                                :stroke-width="5"
                                                :animateSpeed="20000"
                                                timing-func="ease-in"
                                                :total-steps="quantity">
                               <p class="demo-result">@{{percent}}%</p>
                               <p @click="getAsset">еще раз</p>
                           </radial-progress-bar>
                           <div class="errors" v-if="errors">
                               <p v-for="error in errors">@{{error.word}} - @{{error.value}}</p>
                           </div>
                       </template>
                   </div>
                   <div class="variants"  v-if="question.word">
                       <p class="pointer" v-for="variant in variants" @click="check(variant)">@{{variant.text}}</p>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>
<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">Lorem ipsum dolor sit amet</h2>
                <p class="lead">Sed vel mi ac felis aliquam lobortis.
                    Vivamus iaculis mauris faucibus tortor lobortis tempor.
                    Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                    Aenean sit amet placerat neque, in faucibus turpis. Sed sagittis eleifend lacinia.
                    Nam ut commodo velit, sit amet rutrum nulla. Fusce malesuada enim arcu, et vehicula nibh commodo vel.
                    Vestibulum tristique eros risus, eu laoreet lectus fringilla ac.</p>
            </div>
            <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                <div id="text_view">
                    <p class="origtext" v-html="output"></p>
                    <textarea
                            style="height: 280px"
                            class="panel"
                            id="transarea"
                            placeholder="Поле для перевода"
                            v-model="input"
                            @input="separate"
                    ></textarea>
                    <button :plain="true" @click="clear" class="pull-right btn btn-warning">Очистить</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-section-b">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">Lorem ipsum dolor sit amet</h2>
                <p class="lead">Sed vel mi ac felis aliquam lobortis.
                    Vivamus iaculis mauris faucibus tortor lobortis tempor.
                    Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                    Aenean sit amet placerat neque, in faucibus turpis. Sed sagittis eleifend lacinia.
                    Nam ut commodo velit, sit amet rutrum nulla. Fusce malesuada enim arcu, et vehicula nibh commodo vel.
                    Vestibulum tristique eros risus, eu laoreet lectus fringilla ac.</p>
            </div>
            <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                <img class="img-responsive illustration" src="/img/dear-4.png" alt="">
            </div>
        </div>
    </div>
</div>
<div class="content-section-b" id="langauges">
    <div class="container full-width">
        <div class="row">
            <div class="col-lg-3 col-sm-6 icelandic text-center">
                <div class="card">
                    <div class="card-header">
                        <a href="https://icelandic.scandinaver.org">
                            <p style="font-family: 'Julius Sans One',sans-serif;">icelandic.scandinaver.org</p>
                        </a>
                    </div>
                    <div class="clearfix"></div>
                    <a href="https://icelandic.scandinaver.org">
                        <div class="illustrate"></div>
                    </a>
                    <p class="lead">Здесь нет ни насекомых, ни деревьев, вообще ничего.
                        Люди живут здесь, только потому что здесь родились.
                        Понимай, как хочешь, то ли божья кара, то ли благодать.</p>
                    <div class="clearfix"></div>
                    <div class="card-footer text-right">

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 sweden text-center">
                <div class="card">
                    <div class="card-header">
                        <a href="https://swedish.scandinaver.org">
                            <p style="font-family: 'Julius Sans One',sans-serif;">swedish</p></a>
                    </div>
                    <a href="https://swedish.scandinaver.org">
                        <div class="illustrate"></div>
                    </a>
                    <p class="lead">— У меня есть адрес, — сказал он и протянул ему бумажку. [...] — Сейчас они живут в
                        Швеции.
                        Этого только не хватало, подумал Карл.
                        Швеция, страна с самыми крупными на свете комарами и с самой гадкой на свете едой.</p>
                    <div class="clearfix"></div>
                    <div class="card-footer text-right">

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 norwegian disabled">
                <div class="card">
                    <div class="illustrate"></div>
                    <p class="lead">В разработке</p>
                    <div class="card-footer text-right">

                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 finnish disabled">
                <div class="card">
                    <div class="illustrate"></div>
                    <p class="lead">В разработке</p>
                <div class="card-footer text-right">

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(!Auth::check())
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">

                </div>
                <div class="col-lg-12 text-center">
                    <a href="#registration"  class="btn btn-default btn-lg fancybox">
                        <span class="network-name">Регистрация</span></a>
                    <a href="#loginmodal"  class="btn btn-default btn-lg fancybox">
                        <span class="network-name">Вход</span></a>
                </div>
            </div>
        </div>
    </div>
@endif
@stop