<template>
    <el-container>
        <el-main>
            <el-row :gutter="20">
                <el-col :span="12">
                    <el-card style="position: relative;" id="origtext">
                        <vue-progress-bar/>
                        <p class="origtext" v-html="output"/>
                    </el-card>
                    <el-collapse id="helpblock">
                        <el-collapse-item title="Помощь">
                            <template v-for="extra in text.extra">
                                <el-col :span="12">
                                    <p class="pointer"
                                       v-on:mouseover="showExtra(extra)"
                                       v-on:mouseout="clearExtra">
                                        <span>{{extra.orig}}</span> - {{extra.extra}}
                                    </p>
                                </el-col>
                            </template>
                        </el-collapse-item>
                    </el-collapse>
                </el-col>
                <el-col :span="12" id="textarea">
                    <textarea
                            style="height: 280px"
                            class="panel"
                            id="transarea"
                            placeholder="Поле для перевода"
                            v-model="input"
                            v-on:input="separate"
                    />

                    <el-row>
                        <el-col :span="24">
                            <el-button :plain="true" @click="clear" class="pull-right">Очистить</el-button>
                            <el-button v-if="nextTextId" type="success" @click="gotonext()" class="pull-right">
                                Следующий текст
                            </el-button>
                        </el-col>
                    </el-row>
                </el-col>
            </el-row>
        </el-main>
    </el-container>
</template>

<script>

    export default{
        metaInfo () {
            return {
                title: 'Перевод | ' + this.text.title,
            }
        },
        data(){
            return {
                text: {
                    'computed': '',
                    'created_at': '',
                    'updated_at': '',
                    'id': 0,
                    'published': 1,
                    'text': '',
                    'extra': [],
                    'synonims': [],
                    'title': '',
                    'count': 0,
                },
                dictionary: {},
                input: '',
                inputWords: [],
                showedExtra: '',
                showSuccess: false,
                progress: 0,
                nextTextId: 0,
                dictionaryLength: 0
            }
        },
        computed: {
            output(){
                let c = 0;
                let origs = []
                this.dictionaryLength = this.dictionary.length;
                this.text.computed = this.text.text

                this.inputWords.forEach((el) => {
                    el = el.toLowerCase()
                    if (el !== '' && el in this.dictionary)
                        origs = origs.concat(this.dictionary[el].map((item) => { return item = item + '|' + el }))
                })

                origs = origs.filter((v, i, a) => a.indexOf(v) === i)

                for (let i = 0; i < origs.length; i++) {
                    let arr = origs[i].split('|')
                    let word = arr[0].replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&")
                    let tooltip = arr[1]

                    this.text.computed = this.text.computed.replace(
                        new RegExp("(^|\\s)(" + word.trim() + ")([^\\w]|$)", 'gi'),
                        '$1<span class="success-text" tooltip='+tooltip+'>$2</span>$3'
                    );
                    c++;
                }

                if (this.showedExtra != '') {
                    this.text.computed = this.text.computed.replace(
                        new RegExp("(^|\\s|>)(" + this.showedExtra.trim() + ")([^\\w]|$|<)", 'gi'),
                        '$1<span class="warning-text">$2</span>$3'
                    )
                }

                this.progress = Math.floor((c * 100) / this.text.count);

                this.$Progress.set(this.progress)

                if (this.progress > 99) this.showSuccess = true

                return this.text.computed
            }
        },
        created(){
            this.loadText(this.$route.params.id)
        },
        methods: {
            loadText(id){
                this.$http.get('/text/' + id).then(
                    (response) => {
                        if(response.status !== 200){
                            this.$notify.error({
                                title: 'Ошибка',
                                message: response.body.message,
                                duration: 4000
                            });
                        } else {
                            this.clear()
                            this.text = response.body
                            this.text.computed = this.text.text
                            this.titleChunk = this.text.title
                            this.dictionary = this.text.synonims
                            this.nextTextId = 0
                            this.showSuccess = false
                        }
                    },
                    (response) => {
                        console.log(response)
                    }
                )
            },
            separate(){
                this.inputWords = this.input.replace(/\s+/g, " ").replace(/\./g, ' ').replace(/\,/g, '').trim().split(" ");
            },
            showExtra(extra){
                this.showedExtra = extra.orig
            },
            clearExtra(){
                this.showedExtra = ''
            },
            clear(){
                this.input = ''
                this.inputWords = []
                this.progress = 0
            },
            gotonext(){
                this.$router.push('/translates/' + this.nextTextId)
            }
        },
        watch: {
            '$route'(to, from) {
                this.loadText(this.$route.params.id)
            },
            showSuccess: function (val) {
                if (val) {
                    this.$http.post('/nextTLevel', {'id': this.text.id}).then(
                        (response) => {
                            if (response.body.success) {
                                this.nextTextId = response.body.new_level
                                this.$store.commit('setTexts', response.body.texts)
                                this.$notify.success({
                                    title: this.text.title,
                                    message: 'Текст переведен!',
                                    duration: 3000
                                });
                            }
                        },
                        (responce) => {
                            console.log(responce)
                        }
                    )
                }
            }
        }
    }
</script>