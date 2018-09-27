<template>
    <el-col :span="8" :xs="24">
        <el-card class="box-card" id="dictionary_block">
            <div slot="header" class="clearfix">
                <el-row>
                    <el-col :span="7">
                        <p>Поиск</p>
                    </el-col>
                    <el-col :span="11">
                        <el-checkbox v-model="sentence">В предложениях</el-checkbox>
                    </el-col>
                    <el-col :span="6">
                        <el-button @click="dialogFormVisible = true">Добавить</el-button>
                    </el-col>
                </el-row>
            </div>
                <el-input placeholder="слово для поиска.." v-model="word" @change="livesearch">
                    <el-button slot="append" icon="el-icon-search" @click="search"></el-button>
                </el-input>
            <p v-if="message" class="text-muted">{{message}}</p>
            <section data-scrollbar style="height: 65vh;">
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
                    <p class="small">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Aliquam eros mi, hendrerit sed lacinia ac, semper sed libero.
                        Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                        Donec dignissim a elit eget vestibulum. Duis lacinia euismod mauris eu suscipit.
                        Nulla facilisi. Vivamus non pharetra leo. Sed at dolor pretium, rutrum enim at, tincidunt ipsum.
                        Aenean dictum faucibus lectus, nec commodo justo.
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
                }
            }
        },
        components:{
            'translate': Translate
        },
        methods:{
            livesearch(){
               if(this.word.length > 2) {this.search()}
            },
            search(){
                if(this.word === '') return false

                this.$http.get('/translate', {params:  {word: this.word, sentence: +this.sentence}}).then(
                    (response) => {
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