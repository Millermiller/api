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
            <div class="col-lg-6 col-sm-pull-6 col-sm-6">
                <div id="text_view" v-cloak>
                    <div class="cov-progress" :style="{width: progress + '%'}"></div>
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