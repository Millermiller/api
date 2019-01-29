<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">Слова и предложения</h2>
                <p class="lead">
                    Мы приготовили сотни словарных карточек для каждого языка.
                    Карточка содержит слово, перевод, пример использования и произношение.
                    Также, вы можете создавать личные словари со своими карточками.
                </p>
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
                                                    <div class="example-item">
                                                        <p v-html="example.text" class="example-text"></p>
                                                        <i v-html="example.value" class="example-value"></i>
                                                        <i class="icon ion-bookmark text-danger"></i>
                                                    </div>
                                                </template>
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