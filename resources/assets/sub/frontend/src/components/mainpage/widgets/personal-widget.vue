<template>
    <el-col :span="8">
        <el-card shadow="hover" :class="['widget-block', 'personal-widget-block', 'pointer']"  @click.native="personal()">
            <p :class="['widget-title']">Мои словари</p>
            <p :class="['widget-description']">{{all}}</p>
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
            all(){
                return this.$store.getters.personal.length;
            }
        },
        methods:{
            personal(){
                this.$router.push('/cards')
            }
        }
    }
</script>