<template>
    <b-modal :active.sync="visible" @close="close">
        <div class="box">
            <div class="header">{{card.id}} - {{card.word.word}}</div>
            <div class="translate-section">
                <p class="control">
                    <input class="input" type="text" placeholder="text" v-model="text" :value="card.word.word"
                           style="width: 490px;">
                </p>
                <hr>
                <div class="variants">
                    <h2 class="subtitle is-5">Варианты перевода:</h2>
                    <ul>
                        <li v-for="word in values"
                            @click="setActive(word)"
                            :class="['variant', {'is-success': word.active }]">
                            {{word.value}}
                        </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="example-section">
                <h2 class="subtitle is-5">
                    Примеры: <span @click="addExample" class="button is-success pull-right">добавить</span>
                </h2>
                <div>
                    <example
                            v-for="(item, index) in examples"
                            :item="item"
                            :index="index"
                            :key="item.id"
                            v-on:remove="removeExample"
                    >
                    </example>
                </div>
            </div>
            <hr>
            <div class="audio-section">
                <audio ref="audio" :src="card.word.audio" preload="auto"></audio>
                <a :class="['button', 'is-small']" @click="play">
                    <span class="icon">
                          <i class="fa fa-volume-up"></i>
                    </span>
                </a>

                <form enctype="multipart/form-data" action="" method="post" name="addAudio" ref="audioform">
                    <input type="file" name="audiofile" @change="bindFile"/>
                    <a class="button is-success" @click="updateAudio">Загрузить аудио</a>
                    <a class="button is-success" @click="updateTranslate">Сохранить</a>
                    <a class="button is-warning" @click="close">Отмена</a>
                </form>
            </div>
        </div>
    </b-modal>
</template>

<script>
    import Example from './Modal_example.vue'

    export default {
        data () {
            return {
                fileUploadFormData: new FormData(),
                text: '',
                values: [],
                examples: []
            }
        },
        components: {
            Example
        },
        props: ['visible', 'card', 'index'],
        methods: {
            bindFile (e) {
                e.preventDefault();
                this.fileUploadFormData.append('audiofile', e.target.files[0]);
                this.fileUploadFormData.append('id', this.card.word.id);
            },
            close () {
                this.$emit('close')
            },
            updateAudio () {
                this.$http.post('/admin/audio', this.fileUploadFormData).then((response) => {
                    if (response.body.success) {
                        this.$store.commit('changeAssetAudio', {index: this.index, url: response.body.url})
                        this.close()
                    }
                }, (response) => {
                    console.log(response)
                })
            },
            updateTranslate () {
                this.$http.post('/admin/translate',
                    {
                        card_id: this.card.id,
                        id: this.card.translate.id,
                        text: this.text,
                        examples: this.examples
                    }
                ).then((response) => {
                    if (response.body.success) {
                        this.$store.commit('changeAssetWord', {index: this.index, text: this.text})
                    }
                    this.close()
                }, (response) => {
                    console.log(response)
                })
            },
            setActive (word) {
                this.$http.post('/admin/changeUsedTranslate',
                    {
                        card_id: this.card.id,
                        word_id: this.card.word.id,
                        translate_id: word.id
                    }
                ).then((response) => {
                    if (response.body.success) {
                        this.text = word.value
                        for (let v in this.values) {
                            this.values[v].active = false
                        }
                        word.active = true
                        this.$store.commit('changeAssetTranslate', {index: this.index, translate: word})
                        this.close()
                    }
                }, (response) => {
                    console.log(response)
                })
            },
            play () {
                this.$refs.audio.play()
            },
            addExample(){
                this.examples.push({text: '', value: ''})
            },
            removeExample(i){
                this.examples.splice(i, 1)
            }
        },
        watch: {
            visible: function (val) {
                if (val) {
                    this.$http.get('/admin/values/' + this.card.word_id).then((response) => {
                        this.values = response.body.values
                        for (let v in this.values) {
                            if (this.values[v].id === this.card.translate_id) {
                                this.values[v].active = true
                            }
                        }
                    }, (response) => {
                        console.log(response)
                    })
                    this.$http.get('/admin/examples/' + this.card.id).then((response) => {
                        this.examples = response.body.values
                    }, (response) => {
                        console.log(response)
                    })
                }
            }
        },
        mounted () {
            this.text = (this.card.translate) ? this.card.translate.value : ''
        }
    }
</script>