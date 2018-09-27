<template>
    <el-container>
        <el-main>
            <el-row :gutter="20">
                <slider></slider>
                <tabs v-on:modal="modal"></tabs>
            </el-row>
        </el-main>
        <el-dialog title="Это закрытая часть сайта" :visible.sync="dialogVisible">
                    <span>
                        <a href="scandinaver.local" target="_blank">Оплатите подписку</a> чтобы получить полный доступ
                    </span>
            <span slot="footer" class="dialog-footer">
                        <el-button @click="dialogVisible = false">Закрыть</el-button>
                    </span>
        </el-dialog>
    </el-container>
</template>

<script type="text/babel">
    import Tabs from './tabs.vue';
    import Slider from './slider.vue';

    export default{
        data(){
            return {
                dialogVisible: false,
            }
        },
        components: {
            'slider': Slider,
            'tabs': Tabs
        },
        methods: {
            modal(){
                this.dialogVisible = true
            }
        },
        beforeDestroy(){
            this.$store.dispatch('onCardsPageClose')
        }
    }
</script>
