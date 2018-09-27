<template>
    <el-col :span="8" :xs="24" id="my-intro" class="sentences-steps">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <span style="line-height: 36px;">Мои словари</span>
            </div>
            <section data-scrollbar ref="personalscroll">
                <div class="steps-wrapper">
                    <personalitem v-for="(item, index) in personal" :key="index" v-bind:item="item" :index="index"></personalitem>
                </div>
            </section>
        </el-card>
    </el-col>
</template>

<script type="text/babel">
    import Scrollbar from 'smooth-scrollbar';
    import Personalitem from './personal-item.vue';

    export default{

        data(){
            return {
                scrollbar: {}
            }
        },
        created: function () {

        },
        components: {
            'personalitem': Personalitem
        },
        methods: {},
        computed: {
            personal(){
                return this.$store.getters.personal;
            }
        },
        mounted(){
            this.scrollbar = Scrollbar.init(this.$refs.personalscroll, {
                alwaysShowTracks: false,
                overscrollEffect: 'bounce'
            });
        }
    }
</script>
