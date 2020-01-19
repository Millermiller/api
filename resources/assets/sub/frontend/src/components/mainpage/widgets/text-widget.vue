<template>
    <el-col :span="8" :xs="24" id="textwidget">
        <el-card :class="['widget-block', 'pointer']" shadow="hover" @click.native="text()">
            <p :class="['widget-title']">Тексты</p>
            <p :class="['widget-description']">{{active}}/{{all}}</p>
            <el-progress type="circle" :percentage="percent"/>
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
                this.active = this.$store.getters.activeTexts
                this.all = this.$store.getters.texts.length
            }, 500)
        },
        methods:{
            text(){
                this.$router.push('/translates')
            }
        }
    }
</script>