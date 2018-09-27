<template>
    <el-col :span="8">
        <el-card :class="['widget-block', 'pointer']" shadow="hover" @click.native="text()">
            <p :class="['widget-title']">Тексты</p>
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
                return Math.round(100 * this.$store.getters.activeTexts / this.$store.getters.texts.length);
            },
            active(){
                return this.$store.getters.activeTexts
            },
            all(){
                return this.$store.getters.texts.length
            }
        },
        methods:{
            text(){
                this.$router.push('/translates')
            }
        }
    }
</script>