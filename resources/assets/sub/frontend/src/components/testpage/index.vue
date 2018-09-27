<template>
    <el-container>
        <el-main>
            <el-row :gutter="20">
                <result></result>
                <test></test>
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

<script>
    import result from './result.vue'
    import test from './test.vue'
    import tabs from './tabs.vue'

    export default{
        data(){
            return {
                dialogVisible: false,
            }
        },
        components: {
            'result': result,
            'test': test,
            'tabs': tabs
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
