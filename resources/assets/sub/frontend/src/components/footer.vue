<template>
    <el-row id="footer">
        <el-row :gutter="20" class="footer-inner">
            <el-col :span="12">
               <span class="copyright">scandinaver.org © 2018</span>
            </el-col>
            <el-col  :md="{span:4, offset:8}" :xs="{span:12}">
                <el-button type="text" @click="showIntro()">Помощь</el-button>
                <el-button type="text" @click="dialogFormVisible = true">Обратная связь</el-button>
            </el-col>
        </el-row>

        <el-dialog title="Ваше сообщение:" :visible.sync="dialogFormVisible">
            <el-form :model="form" :rules="rules" ref="messageform">
                <el-form-item prop="message">
                    <el-input type="textarea" v-model="form.message"  placeholder="Сообщение" id="feedback_message"></el-input>
                </el-form-item>
            </el-form>
            <span slot="footer" class="dialog-footer">
                    <el-button @click="dialogFormVisible = false">Отмена</el-button>
                    <el-button type="primary" @click="submit">Отправить</el-button>
                </span>
        </el-dialog>
    </el-row>
</template>

<script>
    import introJs from 'intro.js/intro';

    export default{
        data(){
            return {
                dialogFormVisible: false,
                introVisible: false,
                form: {
                    subject: '',
                    message: ''
                },
                rules: {
                    message: [
                        {required: true, message: 'Поле не может быть пустым!', trigger: 'sumbit'},
                    ]
                },
            }
        },
        methods:{
            submit(){
                this.$refs.messageform.validate((valid) => {
                    if (valid) {
                        this.$http.post('feedback', {message: this.form.message}).
                        then(
                            (response) => {
                                if(response.status === 201){
                                    this.dialogFormVisible = false
                                    this.$notify.success({
                                        title: '',
                                        message: "Сообщение отправлено",
                                        duration: 2000
                                    });
                                    this.form.subject = this.form.message = ''
                                }
                            },
                            (response) => {
                                this.dialogFormVisible = false
                                console.log(response.body)
                            })
                    } else {
                        return false;
                    }
                });
            },
            showIntro(){
                this.$store.commit('setIntroVisibility', {page: this.$route.name, visible:true})
            },
            startIntro(name){
                let intr = introJs.introJs()

                intr.setOptions({
                    steps:this.$store.getters.intro(name),
                    showStepNumbers: false,
                    nextLabel: 'Вперед &rarr;',
                    prevLabel: '&larr; Назад',
                    skipLabel: 'Пропустить',
                    doneLabel: 'Завершить'})
                    .start()

                this.$store.commit('setIntroVisibility', {page: name, visible: false})
            }
        },
        mounted(){
            let self = this;

            this.$store.watch( function (state) { return  state.introNeed },
                function (val) {
                    if(val.main && self.$route.name === 'main')      self.startIntro('main')
                    if(val.learnHome && self.$route.name === 'learnHome') self.startIntro('learnHome')
                    if(val.learn && self.$route.name === 'learn') self.startIntro('learn')
                    if(val.testHome && self.$route.name  === 'testHome')  self.startIntro('testHome')
                    if(val.test && self.$route.name  === 'test')      self.startIntro('test')
                    if(val.cards && self.$route.name === 'cards')     self.startIntro('cards')
                    if(val.texts && self.$route.name === 'texts')     self.startIntro('texts')
                    if(val.text && self.$route.name === 'text')       self.startIntro('text')
                },
                {deep: true}
            );
        }
    }
</script>
