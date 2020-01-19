<div class="content-section-a">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-sm-6">
                <hr class="section-heading-spacer">
                <div class="clearfix"></div>
                <h2 class="section-heading">Словарные паззлы</h2>
                <p class="lead">Разместите слова в правильном порядке.</p>
            </div>
            <div class="col-lg-5 col-lg-offset-2 col-sm-6">
                <div id="puzzle_view" class="row" v-cloak>
                    <div class="cov-progress" :style="{width: progress + '%'}"></div>
                    <div class="col-lg-12">
                        <h3 class="text-center">@{{translate}}<i @click="refresh"
                                                                 :class="['ion', 'ion-android-refresh', 'pointer', {'rotating': isRotate}]"></i>
                        </h3>
                    </div>
                    <div class="col-lg-12 drop-wrapper">
                        <drop :class="['drop', 'list', zone.class]"
                              v-for="(zone, index) in dropzones"
                              @drop="handleDrop(zone, ...arguments)"
                              @dragenter="handleDragEnter(zone, ...arguments)"
                              @dragleave="handleDragLeave(zone, ...arguments)">
                            <transition name="bounce">
                                <drag class="drag"
                                      :key="item"
                                      v-for="item in zone.content"
                                      :transfer-data="{ zone: zone, item: item, list: zone.content}">
                                    @{{ item }}
                                </drag>
                            </transition>
                        </drop>
                    </div>
                    <div class="col-lg-12">
                        <p class="text-center">разместите слова в правильном порядке <i
                                    class="ion ion-android-arrow-up"></i></p>
                    </div>
                    <div class="col-lg-12">
                        <drop :class="['drop-wrapper', {'gray-bordered': shufflewords.length > 0}]"
                              @drop="handleBackDrop(shufflewords, ...arguments)">
                            <drag v-for="item in shufflewords"
                                  class="drag elem"
                                  :key="item"
                                  :transfer-data="{ item: item, list: shufflewords, example: 'lists' }">
                                @{{ item }}
                            </drag>
                        </drop>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>