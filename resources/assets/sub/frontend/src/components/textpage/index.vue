<template>
    <el-container>
        <el-main>
            <el-row :gutter="20">
                <textcard v-for="text in texts" :text="text" :key="text.id"></textcard>
            </el-row>
        </el-main>
    </el-container>
</template>

<script>
    import Textcard from './textcard.vue'

    export default{
        metaInfo: {
            title: 'Переводы',
        },
        components:{
            Textcard
        },
        computed: {
            texts(){
                return this.$store.getters.texts
            }
        }
    }
</script>
