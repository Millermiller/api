<div class="content-section-b" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-lg-offset-1 col-sm-push-6  col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">Умный перевод</h2>
                <p class="lead">
                   Переводите текст, а мы сразу покажем правильные слова и прогресс выполнения.
                </p>
            </div>
            <div class="col-lg-6 col-sm-pull-6 col-sm-6">
                <div id="text_view" v-cloak>
                    <div class="cov-progress" :style="{width: progress + '%'}"></div>
                    <p class="origtext" v-html="output"></p>
                    <textarea
                            style="height: 100px"
                            class="panel"
                            id="transarea"
                            placeholder="Поле для перевода"
                            v-model="input"
                            @input="separate"
                    ></textarea>

                    <p>
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Помощь
                        </a>
                        <button :plain="true" @click="clear" class="pull-right btn btn-warning">Очистить</button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <template v-for="extra in text.text_extra">
                                        <div class="col-md-6">
                                            <p class="pointer"
                                               v-on:mouseover="showExtra(extra)"
                                               v-on:mouseout="clearExtra">
                                                <span>@{{extra.orig}}</span> - @{{extra.extra}}
                                            </p>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>