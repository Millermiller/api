<template>
    <el-col :span="8" :xs="24">
        <el-card shadow="hover" :class="['widget-block', 'pointer']" @click.native="sentences()">
            <p :class="['widget-title']">Предложения</p>
            <p :class="['widget-description']">{{active}}/{{all}}</p>
            <el-progress type="circle" :percentage="percent"></el-progress>
        </el-card>
    </el-col>
</template>

<script type="text/babel">
    export default {
        data(){
            return {

            }
        },
        computed:{
            percent(){
                return Math.round(100 * this.$store.getters.activeSentences / this.$store.getters.sentences.length);
            },
            active(){
                return this.$store.getters.activeSentences
            },
            all(){
                return this.$store.getters.sentences.length
            }
        },
        methods:{
            sentences(){
                this.$store.dispatch('setActiveAssetType', 2)
                this.$router.push('/learn')
            }
        }
    }
</script>