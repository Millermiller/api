<template>
    <el-container>
        <el-main>
            <a id="right-menu" @click="toggleRightMenu">
                <button :class="['navbar-toggle', 'collapsed']">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </a>
            <el-row :gutter="20" type="flex" justify="center">
                <el-col :lg="{span: 12}" :xs="{span: 24, offset: 0}">
                    <el-card :style="{position: 'relative'}" :class="['box-card']">
                        <vue-progress-bar></vue-progress-bar>

                        <h3 class="text-center">{{text}}
                            <i @click="refresh"  v-if="activePuzzle" :class="['ion', 'ion-android-refresh', 'pointer', {'rotating': isRotate}]"></i>
                        </h3>

                        <div class="drop-wrapper">
                            <drop :class="['drop', 'list', zone.class]"
                                  v-for="(zone, index) in dropzones"
                                  :key="index"
                                  @drop="handleDrop(zone, ...arguments)"
                                  @dragenter="handleDragEnter(zone, ...arguments)"
                                  @dragleave="handleDragLeave(zone, ...arguments)">
                                <transition name="bounce">
                                    <drag class="drag"
                                          :key="item"
                                          v-for="item in zone.content"
                                          :transfer-data="{ zone: zone, item: item, list: zone.content}">
                                        {{ item }}
                                    </drag>
                                </transition>
                            </drop>
                        </div>

                        <el-row :gutter="20" type="flex" justify="center">
                            <el-col :span="14"  v-if="activePuzzle">
                                <p :style="{margin: '20px 0'}">разместите слова в правильном порядке <i class="ion ion-android-arrow-up"></i></p>
                            </el-col>
                            <el-col :span="14" v-else>
                                <p :style="{margin: '20px 0'}" :class="['text-center']">Выберите предложение <i style="font-size: 16px" class="ion ion-arrow-right-c"></i></p>
                            </el-col>
                        </el-row>

                        <el-row :gutter="20" type="flex" justify="center">
                            <el-col :span="20">
                                <drop :class="['drop-wrapper', {'gray-bordered': shufflewords.length > 0}]"
                                      @drop="handleBackDrop(shufflewords, ...arguments)">
                                    <drag v-for="item in shufflewords"
                                          class="drag elem"
                                          :key="item"
                                          :transfer-data="{ item: item, list: shufflewords, example: 'lists' }">
                                        {{ item }}
                                    </drag>
                                </drop>
                            </el-col>
                        </el-row>
                    </el-card>
                </el-col>
                <el-col :span="8" :xs="{span: 24, offset: 0}" :class="['right-panel']">
                    <el-card :class="['box-card', 'puzzle-wrapper']" v-loading.body="loading">
                        <template>
                            <el-tooltip v-for="(puzzle, index) in puzzles" :key="index" class="item" effect="dark" :content="puzzle.text" placement="top-start">
                                <div  :class="['puzzle-item', {active: puzzle.active, success: puzzle.success}]"
                                      @click="createPuzzle(puzzle)">
                                    {{index + 1}}
                                </div>
                            </el-tooltip>
                        </template>
                    </el-card>
                </el-col>
            </el-row>
        </el-main>
    </el-container>
</template>

<script>
    import Item from './item.vue'

    export default {
        metaInfo: {
            title: 'Паззлы',
        },
        components: {
            Item
        },
        data(){
            return {
                puzzles: [],
                activePuzzle: false,
                text: '',
                translate: '',
                words: [],
                shufflewords: [],
                dropzones: [],
                success: 0,
                words_count: 0,
                isRotate: false,
                loading: false
            }
        },
        created(){
            this.load()
        },
        methods:{
            load(){
                this.loading = true
                this.$http.get('/puzzle').then((response) => {
                    this.puzzles = response.body
                    this.loading = false
                }, (response) => {
                    console.log(response)
                })
            },
            createPuzzle(puzzle){

                this.puzzles.forEach((puzzle) => puzzle.active = false)
                this.success = 0
                this.$Progress.set(0)
                this.activePuzzle = puzzle
                puzzle.active = true
                this.text = puzzle.text
                this.translate = puzzle.translate
                this.words = this.translate.split(" ")
                this.shufflewords = this.translate.split(" ").shuffle()
                this.words_count = this.words.length
                this.dropzones = []

                for (let i = 0; i < this.words.length; i++) {
                    this.dropzones.push({
                        'for': this.words[i],
                        'content': [],
                        'class': 'dragover'
                    })
                }
            },
            handleDrop(toList, data) {

                const fromList = data.list;
                if (data.item === toList.for) {
                    toList.content.push(data.item);
                    fromList.splice(fromList.indexOf(data.item), 1);
                    this.success++
                    this.$Progress.set(Math.floor((this.success * 100) / this.words_count))

                    if(this.$Progress.get() === 100){
                        this.attach(this.activePuzzle)
                    }
                }
                else{
                    toList.class = 'dragover'
                }
            },
            handleBackDrop(toList, data){
                const fromList = data.list;

                if(data.zone){
                    toList.push(data.item);
                    fromList.splice(fromList.indexOf(data.item), 1);
                    data.zone.class = 'dragover'
                    this.success--
                    this.$Progress.set(Math.floor((this.success * 100) / this.words_count))
                }
            },
            handleDragEnter(ev, data){
                ev.class = 'dragenter'
            },
            handleDragLeave(ev, data){
                if(!ev.content.length)
                    ev.class = 'dragover'
            },
            refresh(){
                let self = this
                this.isRotate = true
                this.words = this.translate.split(" ")
                this.shufflewords = this.translate.split(" ").shuffle()
                this.dropzones = []
                this.$Progress.set(0)
                this.success = 0
                this.words_count = this.words.length

                for (let i = 0; i < this.words.length; i++) {
                    this.dropzones.push({
                        'for': this.words[i],
                        'content': [],
                        'class': 'dragover'
                    })
                }

                setTimeout(function(){
                    self.isRotate = false
                }, 1000)
            },
            toggleRightMenu(){
                this.visible = !this.visible;
                this.$store.dispatch('toggleMenuOpen')
                this.$store.dispatch('toggleBackdrop')
            },
            attach(puzzle){
                this.$http.put('/puzzle/' + puzzle.id).then((response) => {
                    this.$notify.success({
                        title: 'Все правильно!',
                        //  message: 'Добавлено в Избранное',
                        duration: 2000
                    });
                    puzzle.success = true
                }, (response) => {
                    console.log(response)
                })
            }
        }
    }
</script>