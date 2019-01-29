<div class="content-section-b">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">Новые уровни</h2>
                <p class="lead">
                   Проверяйте свои знания и открывайте новые словари, проходя тесты.
                </p>
            </div>
            <div class="col-lg-5 col-sm-pull-6  col-sm-6">
                <div id="test_view" v-cloak>

                    <div slot="header">
                        <div :class="['cov-progress', {'cov-error': error}]" :style="{width: progress + '%'}"></div>
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
                                <p class="btn btn-success" @click="getAsset">еще раз</p>
                            </radial-progress-bar>
                           <!-- <div class="errors" v-if="errors">
                                <p v-for="error in errors">@{{error.word}} - @{{error.value}}</p>
                            </div> -->
                        </template>
                    </div>
                    <ul class="variants" v-if="question.word">
                        <li class="pointer" v-for="(variant, index) in variants" @click="check(variant)">
                            <span class="counter">@{{ index + 1 }}.</span>
                            @{{variant.text}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>