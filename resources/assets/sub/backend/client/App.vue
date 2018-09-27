<template>
    <div id="app">

        <navbar :show="true"></navbar>
        <sidebar :show="sidebar.opened && !sidebar.hidden"></sidebar>
        <app-main></app-main>
    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex'
    import Navbar from 'components/layout/Navbar.vue'
    import Sidebar from 'components/layout/Sidebar.vue'
    import AppMain from 'components/layout/AppMain.vue'
    import FooterBar from 'components/layout/FooterBar.vue'

    export default {
        components: {
            Navbar,
            Sidebar,
            AppMain,
            FooterBar,

        },

        beforeMount () {
            const {body} = document
            const WIDTH = 768
            const RATIO = 3

        },

        computed: mapGetters({
            sidebar: 'sidebar'
        }),

        methods: mapActions([
            'toggleDevice',
            'toggleSidebar'
        ])
    }
</script>

<style lang="scss">
    @import "./assets/scss/main.scss";
</style>
