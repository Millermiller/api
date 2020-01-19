<template>
    <div id="app">
        <appheader v-if="auth"/>
        <sidemenu v-if="auth"/>
        <router-view/>
        <appfooter v-if="auth"/>
    </div>
</template>

<script>
    import Header from './header.vue';
    import Footer from './footer.vue';
    import Sidemenu from './sidemenu.vue';
    import auth from '../auth'

    export default{
        components:{
            'sidemenu': Sidemenu,
            'appheader': Header,
            'appfooter': Footer,
        },
        computed:{
           auth(){
               return this.$store.getters.auth;
           }
        }
    }
</script>