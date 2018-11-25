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
                active: 0,
                all: 1
            }
        },
        computed:{
            percent(){
                return Math.round(100 * this.active / this.all);
            },
        },
        created(){
            setTimeout(() => {
                this.active = this.$store.getters.activeSentences
                this.all = this.$store.getters.sentences.length
            }, 500)
        },
        methods:{
            sentences(){
                this.$store.dispatch('setActiveAssetType', 2)
                this.$router.push('/learn')
            }
        }
    }
</script>