<template>
    <el-col :span="8" :xs="24" id="words-intro" class="word-steps">
        <el-card class="box-card">
            <div slot="header" class="clearfix">
                <span style="line-height: 36px;">Слова</span>
                <i :class="['ion pointer pull-right', view == 'list' ? listClass : gridClass]"
                   @click="changeView"
                   style="margin: 5px;">
                </i>
                <i :class="['ion', 'ion-ios-loop-strong', 'pull-right', {rotated: rotate}]"
                   @click="reload"
                   style="margin: 5px;">
                </i>
            </div>
            <section data-scrollbar ref="wordscroll">
                <div class="steps-wrapper">

                    <template v-if="view == 'grid'">
                        <griditem v-for="word in words" v-bind:item="word" :key="word.id" v-on:modal="modal"></griditem>
                    </template>

                    <template v-if="view == 'list'">
                        <listitem v-for="(word, index) in words" :index="index" :item="word" :key="word.id" v-on:modal="modal"></listitem>
                    </template>

                </div>
            </section>
        </el-card>
    </el-col>
</template>

<script type="text/babel">
    import Scrollbar from 'smooth-scrollbar';
    import Griditem from './word-item-grid.vue';
    import Listitem from './word-item-list.vue';

    export default{
        data(){
            return {
                rotate: false,
                view: 'list',
                listClass: 'ion-ios-grid-view-outline',
                gridClass: 'ion-ios-list-outline',
                scrollbar: {}
            }
        },
        components: {
            'griditem': Griditem,
            'listitem': Listitem
        },
        created(){

        },
        computed: {
            words(){
                return this.$store.getters.words;
            }
        },
        methods: {
            reload(){
                const self = this;
                this.$http.get('/words').then((response) => {
                    this.$store.commit('setWords', response.body)
                }, (response) => {
                    console.log(response);
                });
                self.startRotate();
                setTimeout(function () { self.stopRotate() }, 1000)
            },
            startRotate(){
                this.rotate = true;
            },
            stopRotate(){
                this.rotate = false;
            },
            modal(){
                this.$emit('modal')
            },
            changeView(){
                this.scrollbar.setPosition(0, 0)
                this.view = (this.view === 'list') ? 'grid' : 'list'
                this.scrollbar.update()
            },
        },
        mounted(){
            this.scrollbar = Scrollbar.init(this.$refs.wordscroll, {
                alwaysShowTracks: false,
                overscrollEffect: 'bounce'
            });
        }
    }
</script>
