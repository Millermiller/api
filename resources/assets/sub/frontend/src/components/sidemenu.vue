<template>
    <div>
        <transition name="custom-classes-transition"
                    enter-active-class="animated slideInLeft"
                    leave-active-class="animated slideOutLeft">
            <div class="sidemenu" v-show="visible">
                <div class="sidemenu-toolbar">
                    <div class="avatar-wrapper-big pull-left">
                        <div class="avatar" :style = "{background: avatar}"></div>
                    </div>
                    <div class="userinfo pull-left">
                        <p class="userlogin">{{login}}</p>
                        <p class="useremail">{{email}}</p>
                    </div>
                    <i class="ion-ios-close-empty ion-big pull-right" @click="toggle"></i>
                </div>
                <div class="sidemenu-content" @click="toggle">
                    <el-menu mode="vertical" default-active="1" class="el-menu-vertical">
                        <el-menu-item index="1">
                            <i class="ion-ios-home-outline ion"></i>
                            <router-link to="/" exact>На главную</router-link>
                        </el-menu-item>
                        <el-menu-item index="2">
                            <i class="ion-university ion"></i>
                            <router-link to="/learn">Обучение</router-link>
                        </el-menu-item>
                        <el-menu-item index="3">
                            <i class="ion-android-checkbox-outline ion"></i>
                            <router-link to="/test">Тесты</router-link>
                        </el-menu-item>
                        <el-menu-item index="4">
                            <i class="ion-android-checkbox-outline ion"></i>
                            <router-link to="/cards">Словари</router-link>
                        </el-menu-item>
                    </el-menu>
                </div>
            </div>
        </transition>
        <div class="sidenav-backdrop" :style="backdrop"></div>
    </div>
</template>

<script type="text/babel">

    export default{
        data(){
            return {
                visible: false,
                backdrop: {
                    opacity: 0
                }
            }
        },
        computed:{
            avatar(){
                return 'url(' +this.$store.getters.avatar + ')'
            },
            login(){
                return this.$store.getters.login;
            },
            email(){
                return this.$store.getters.email;
            }
        },
        created: function () {

        },
        methods: {
            toggle(){
                this.visible = !this.visible;
                this.backdrop.opacity = 0;
            }
        },
        mounted(){
            var data = this;
            this.$root.$on('show', function () {
                data.visible = true;
                data.backdrop.opacity = 1;
            })
        }
    }
</script>
