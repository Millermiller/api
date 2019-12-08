<template>
    <el-col :span="8" :xs="24" id="testblock">
        <el-card class="box-card" v-loading.body="loading">
            <div slot="header" class="clearfix">
                <vue-progress-bar></vue-progress-bar>
                <h3 style="height: 76px;" class="text-center">{{question.word ? question.word.word : 'Выберите словарь'}}</h3>
            </div>
            <div class="variants">
                <p class="pointer" v-for="variant in variants" @click="check(variant)">{{variant.text}}</p>
            </div>
        </el-card>

        <el-dialog title="Результаты:" :visible.sync="dialogVisible">
            <el-row type="flex" align="middle">
                <el-col :md="18">
                    <p v-if="percent >= 80 && asset.basic" class="success">Вы перешли на следующий уровень!</p>
                    <p v-if="percent < 80 && asset.basic" class="text-danger">Вы не прошли тест!</p>
                    <p>Правильные ответы: {{success}} из {{quantity}}</p>
                </el-col>
                <el-col :md="6">
                    <span :class="['percentage',  percent < 80 ? 'warning' : 'success']">{{percent}}%</span>
                </el-col>
            </el-row>
            <template v-if="fail > 0">
                <el-row>
                    <p>Ошибки:</p>
                    <p v-for="error in errors">{{error.word.word}} - {{error.translate.value}}</p>
                </el-row>
            </template>
            <span slot="footer" class="dialog-footer">
                <el-button v-if="percent < 80 && asset.basic" @click="reload">Попробовать еще раз</el-button>
                <el-button @click="dialogVisible = false">Закрыть</el-button>
            </span>
        </el-dialog>
    </el-col>
</template>

<script>
    export default{
        metaInfo () {
            return {
                title: this.title ? 'Тесты | ' + this.title : 'Тесты',
            }
        },
        data(){
            return {
                id: 0,          // id теста
                title: '',
                cards: [],      // all data
                translates: [], // массив всех translates
                quantity: 0,    // количество вопросов
                question: {},   // текущий вопрос
                variants: [],   // 4 варианта ответа на текущий вопрос

                answers: 0,     // количество данных ответов
                success: 0,     // количество правильных ответов
                percent: 0,     // процент правильных ответов
                fail: 0,        // количество неправильных ответов

                errors: [],      // массив ошибок

                dialogVisible: false,
                loading: false
            }
        },
        computed:{
            asset(){
                return this.$store.getters.asset
            }
        },
        watch: {
            '$route'(to, from) {
                if(this.$route.params.id)
                    this.getAsset(this.$route.params.id)
            }
        },
        created: function () {
            this.$store.commit('resetError')
            if (this.$route.params.id > 0)
                this.getAsset(this.$route.params.id)

        },
        methods: {
            reload(){
                this.getAsset(this.id)
                this.dialogVisible = false
            },
            getAsset(id){
                this.loading = true;
                this.id = id
                this.$http.get('/asset/' + id).then((response) => {
                    if(response.body.success === false){
                        this.$notify.error({
                            title: 'Ошибка',
                            message: response.body.message,
                            duration: 4000
                        });
                    }else{
                        this.$store.commit('setSelection', parseInt(id))
                        this.cards = response.body.cards.shuffle()
                        this.title = response.body.title
                        this.quantity = this.cards.length
                        this.$store.dispatch('setActiveAssetType', response.body.type)
                        this.$store.commit('setQuantity', this.quantity)
                        this.$store.commit('resetError')
                        this.$store.commit('resetPercent')
                        this.translates = []
                        this.success = 0
                        this.answers = 0
                        this.errors = []
                        this.percent = 0

                        this.cards.forEach((el) => { this.translates.push(el.translate.value) })

                        this.$Progress.set(0)
                        this.createTest()
                        this.loading = false
                    }
                }, (response) => {
                    console.log(response);
                });
            },
            check(variant){
                this.answers++
                this.$Progress.set(Math.floor((this.answers * 100) / this.quantity))
                if (variant.correct) {
                    this.$Progress.setColor('#20A0FF')
                    this.success++
                    this.percent = Math.floor((this.success * 100) / this.quantity)
                    this.$store.commit('setPercent', this.percent)
                    this.next()
                }
                else {
                    this.$Progress.setColor('#FF4949')
                    this.fail++
                    this.errors.push(this.question) // todo: use store
                    this.$store.commit('setError', this.question)
                    this.next()
                    return
                }

            },
            next(){
                if (this.cards.length > 0)
                    this.createTest()
                else {
                    this.question = {}
                    this.variants = []
                    this.dialogVisible = true

                    if(this.percent > this.asset.result.result)
                        this.save()

                    if(this.percent > 80)
                        this.nextLevel()
                }
            },
            createTest(){
                this.question = this.cards.pop()
                this.variants = [{'text': this.question.translate.value, 'correct': true}]
                let indexes = []
                let translates = this.translates.slice()
                translates.remove(this.question.translate.value)

                while (this.variants.length < ((this.quantity > 4 ) ? 4 : this.quantity)) {

                    let l = Math.floor(Math.random() * translates.length)

                    if(indexes.indexOf(l) != -1)
                        continue

                    indexes.push(l)

                    this.variants.push({'text': translates[l], 'correct': false})
                }

                this.variants.shuffle()
            },
            save(){
                this.$http.post('/result/' + this.asset.id, {'result': this.percent}).then(
                    (responce) => {
                        this.$store.dispatch('reloadStore')
                    },
                    (responce) => {
                        console.log(responce.body)
                    }
                )
            },
            nextLevel(){
                this.$http.post('/complete/' + this.asset.id).then(
                    (responce) => {
                        this.$store.dispatch('reloadStore')
                    },
                    (responce) => {
                        console.log(responce.body)
                    }
                )
            }
        }
    }
</script>