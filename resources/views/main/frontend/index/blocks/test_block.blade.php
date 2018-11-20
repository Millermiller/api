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
                    Nam ut commodo velit, sit amet rutrum nulla. Fusce malesuada enim arcu, et vehicula nibh commodo
                    vel.
                    Vestibulum tristique eros risus, eu laoreet lectus fringilla ac.</p>
            </div>
            <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                <div id="test_view" v-cloak>

                    <div slot="header">
                        <div class="cov-progress" :style="{width: progress + '%'}"></div>
                        <h3 style="height: 76px;" class="text-center" v-if="question.word">@{{question.word}}
                            <hr>
                        </h3>
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
                    <div class="variants" v-if="question.word">
                        <p class="pointer" v-for="variant in variants" @click="check(variant)">@{{variant.text}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>