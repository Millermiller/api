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
                <div id="slider_view" v-cloak>
                    <swiper ref="awesomeSwiperA" :options="swiperOptionA">
                        <!-- slides -->
                        <swiper-slide v-for="(card, index) in cards" :key="index">
                            <div class="slide">
                                <p class="word">@{{card.word}}</p>
                                <template v-if="!card.nocontrols">
                                    <div :class="['translate-area', 'pointer']" @click="showTranslate(index)">
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
                                    <audio :src="card.audio" :id="card.player" preload="none"
                                           :ref="card.player"></audio>
                                    <i :class="['ion favourite-button pointer', card.favourite ? activeClass : defaultClass]"
                                       @click="favourite(index)"></i>
                                    <i :class="['ion-ios-volume-high', 'ion', 'pointer']"
                                       @click="play(card.player)"></i>
                                </template>
                            </div>
                        </swiper-slide>
                        <!-- Optional controls -->
                        <div class="swiper-pagination" slot="pagination"></div>
                        <div class="swiper-button-prev" slot="button-prev"></div>
                        <div class="swiper-button-next" slot="button-next"></div>
                    </swiper>
                </div>
            </div>
        </div>
    </div>
</div>