<template>
    <el-col :span="8" :xs="24" id="dictblock">
        <el-card class="box-card" id="dictionary_block">
            <div slot="header" class="clearfix">
                <el-row>
                    <el-col :span="7">
                        <span class="h3">Поиск</span>
                    </el-col>
                    <el-col :span="11">
                        <el-checkbox v-model="sentence">В предложениях</el-checkbox>
                    </el-col>
                    <el-col :span="6">


                        <el-popover
                                placement="top-start"
                                width="200"
                                trigger="click"
                                :disabled="isActive"
                                popper-class="text-left"
                                content="Создание карточек недоступно базовым аккаунтам">
                            <el-button slot="reference" @click="openform">Добавить</el-button>
                        </el-popover>
                    </el-col>
                </el-row>
            </div>
                <el-input placeholder="слово для поиска.." v-model="word">
                    <el-button slot="append" icon="el-icon-search" @click="search"></el-button>
                </el-input>
            <p v-if="message" class="text-muted">{{message}}</p>
            <section data-scrollbar style="height: 65vh;" v-loading.body="loading">
                <transition-group name="cards" tag="div">
                    <translate v-for="(card, index) in cards"
                               :key="card.id"
                               :card="card"
                               :index="index"
                               v-on:add="add"
                    ></translate>
                </transition-group>
            </section>
        </el-card>

        <el-dialog title="Новая карточка" :visible.sync="dialogFormVisible">

            <el-form :model="form">
                <el-form-item>
                    <el-input v-model="form.orig"  placeholder="Оригинал"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-input v-model="form.translate" placeholder="Перевод"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-checkbox v-model="form.is_public">Виден для всех</el-checkbox>
                </el-form-item>
            </el-form>

            <el-collapse>
                <el-collapse-item title="Что это?" name="1">
                    <p>
                       Вы можете добавить в наш словарь собственные карточки. При установленном <span class="danger">"виден для всех"</span> ваша карточка будет
                        подписана вашим логином и видна всем пользователям.
                        Оставьте эту опцию отключенной, если не уверены в правильности перевода, ваша карточка не соответствует тематике сайта или вы просто не хотите, чтобы вашу карточку
                        видели другие пользователи.
                        Для удаления/редактирования пользовательских карточек обратитесь к администрации сайта.
                    </p>
                </el-collapse-item>
            </el-collapse>

            <span slot="footer" class="dialog-footer">
                <el-button type="warning" @click="dialogFormVisible = false">Отмена</el-button>
                <el-button type="success" @click="submit">Сохранить</el-button>
            </span>
        </el-dialog>
    </el-col>
</template>

<script>
    import Translate from './translate.vue'

    export default{
        data(){
            return{
                dialogFormVisible: false,
                word: '',
                sentence: false,
                cards: [],
                message: false,
                form: {
                    orig: '',
                    translate: '',
                    is_public: false
                },
                loading: false
            }
        },
        components:{
            'translate': Translate
        },
        computed:{
            isActive(){
                return this.$store.getters.isActive;
            }
        },
        methods:{
            livesearch(){
               if(this.word.length > 2) {this.search()}
            },
            search(){
                if(this.word === '') return false

                this.loading = true

                this.$http.get('/translate', {params:  {word: this.word, sentence: +this.sentence}}).then(
                    (response) => {

                        this.loading = false

                        if(!response.body.success){
                            this.message = response.body.message
                            this.cards = []
                            return false
                        }

                        this.message = false
                        this.cards = response.body.translate

                        let word_ids = []

                        this.$store.getters.cards.forEach(function(el, i, ar){
                            word_ids.push(el.word_id)
                        })

                        this.cards.forEach(function(el, index, array){
                            if(word_ids.indexOf(el.id) >= 0 )
                                el.exist = true
                        })
                    },
                    (response) => {
                        console.log(response)
                    }
                )
            },
            openform(){
                if(this.isActive){
                    this.dialogFormVisible = true
                }
            },
            add(data){
                this.$http.post('/card', data).then(
                    (response) => {
                        if(response.body.success){
                            this.$store.commit('addCard', response.body.card)
                        }
                    },
                    (response) => {

                    }
                )
            },
            submit(){
                this.form.is_public = this.form.is_public ? 1 : 0;

                this.$http.post('/createCard', this.form).then(
                    (response) => {
                        if(response.body.success){
                            this.cards = [response.body.card]
                            this.dialogFormVisible = false
                        }
                    },
                    (response) => {

                    }
                )
            }
        }
    }
</script>