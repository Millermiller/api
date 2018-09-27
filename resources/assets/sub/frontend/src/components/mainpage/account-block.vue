<template>
    <el-col :span="6">
        <el-card :class="['box-card', 'account-card']" shadow="hover">
            <div class="avatar-wrapper-big">
                <img :class="['avatar-small']" :src="avatar" >
            </div>
            <p :class="['text-center', 'username']">{{username}}</p>
            <p :class="['text-center', 'plan-title']">{{plan}}</p>
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
            avatar(){
                return this.$store.getters.avatar
            },
            username(){
                return this.$store.getters.login
            },
            plan(){
                return 'Basic'
            }
        }
    }
</script>