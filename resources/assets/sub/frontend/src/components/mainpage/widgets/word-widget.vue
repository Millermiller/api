<template>
    <el-col :span="8">
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

            }
        },
        computed:{
            percent(){
                return Math.round(100 * this.$store.getters.activeWords / this.$store.getters.words.length);
            },
            active(){
                return this.$store.getters.activeWords
            },
            all(){
                return this.$store.getters.words.length
            }
        },
        methods:{
            words(){
                this.$router.push('/learn')
            }
        }
    }
</script>