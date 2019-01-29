<template>
    <el-col :span="8" :xs="24" id="wordwidget">
        <el-card shadow="hover" :class="['widget-block', 'pointer']"  @click.native="words()">
            <p :class="['widget-title']">Слова</p>
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
            }
        },
        created(){
            setTimeout(() => {
                this.active = this.$store.getters.activeWords
                this.all = this.$store.getters.words.length
            }, 500)
        },
        methods:{
            words(){
                this.$router.push('/learn')
            }
        }
    }
</script>