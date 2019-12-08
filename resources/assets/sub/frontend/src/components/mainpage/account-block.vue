<template>
    <el-col :md="6" :sm="8" :class="['hidden-xs-only']" :id="['accountblock']">
        <el-card :class="['box-card', 'account-card']" shadow="hover">
            <div class="avatar-wrapper-big">
                <img :class="['avatar-small']" :src="user.avatar" >
            </div>
            <p :class="['text-center']">{{user.login}}</p>
            <p :class="['text-center']">{{user.email}}</p>
            <p :class="color(plan.id)">{{plan.name}}</p>
            <p :class="['text-center']" v-if="plan.name !== 'Basic'">активен до: {{active_to}}</p>
        </el-card>
    </el-col>
</template>

<script type="text/babel">
    export default {
        data(){
            return {

            }
        },
        methods:{
            color(value) {
                if(value === 1){
                    return 'text-center plan-title green-plan'
                }
                if(value === 2){
                    return 'text-center plan-title red-plan'
                }
                if(value === 3){
                    return 'text-center plan-title blue-plan'
                }
            }
        },
        computed:{
            user(){
                return this.$store.getters.user
            },
            plan(){
                return this.$store.getters.plan
            },
            active_to(){
                return this.$store.getters.active_to
            }
        }
    }
</script>