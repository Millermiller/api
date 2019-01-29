<template>
    <el-container>
        <el-main>
            <el-row :gutter="20">

              <!--  <wordsblock v-on:modal="modal"></wordsblock>
                <sentencesblock v-on:modal="modal"></sentencesblock>
                <personalblock></personalblock> -->

                <account></account>

                <el-col :md="18" :xs="24" :sm="16">
                    <el-row :gutter="20" :id="widgetblock">
                        <wordwidget></wordwidget>
                        <sentencewidget></sentencewidget>
                        <textwidget></textwidget>
                        <personalwidget></personalwidget>
                        <puzzlewidget></puzzlewidget>
                    </el-row>
                </el-col>
            </el-row>
            <el-dialog title="Это закрытая часть сайта" :visible.sync="dialogVisible">
                    <span>
                        <a href="scandinaver.local" target="_blank">Оплатите подписку</a> чтобы получить полный доступ
                    </span>
                    <span slot="footer" class="dialog-footer">
                        <el-button @click="dialogVisible = false">Закрыть</el-button>
                    </span>
            </el-dialog>

            <el-dialog title="Привет!" :visible.sync="greetingVisible">
                    <span>
                        Добро пожаловать, {{username}}!
                    </span>
                <span slot="footer" class="dialog-footer">
                        <el-button @click="greetingVisible = false">Закрыть</el-button>
                    </span>
            </el-dialog>
        </el-main>
    </el-container>
</template>

<script type="text/babel">

    import Account from './account-block.vue';
    import Wordwidget from './widgets/word-widget.vue';
    import Sentencewidget from './widgets/sentence-widget.vue';
    import Textwidget from './widgets/text-widget.vue';
    import Personalwidget from './widgets/personal-widget.vue';
    import Puzzlewidget from './widgets/puzzle-widget.vue';

    export default {
        name: 'Main',
        metaInfo: {
            title: 'Icelandic | Scandinaver',
        },
        data(){
            return {
                dialogVisible: false,
                greetingVisible: false
            }
        },
        components: {
            Account, Wordwidget, Sentencewidget, Textwidget, Personalwidget, Puzzlewidget
        },
        methods: {
            modal(){
                this.dialogVisible = true
            }
        },
        computed:{
            username(){
                return this.$store.getters.login
            },
        },
        mounted(){
            if (!localStorage.getItem('myFirstAdventure')) {
             //   this.greetingVisible = true;
             //   localStorage.setItem('myFirstAdventure', true)
            }
        }
    };
</script>