<template>
    <el-col :span="8" :xs="{span: 24, offset: 0}" :class="['right-panel']" :id="['cardsblock']">
        <el-card :class="['box-card', 'tab-navigation']">
            <el-tabs  @tab-click="handleClick" :value="active">
                <el-tab-pane label="Слова" name="words">
                    <section data-scrollbar>
                        <ul :class="['nav', 'nav-list']">
                            <tabitem
                                    v-for="(word, index) in words"
                                    :item="word"
                                    :index="index"
                                    :key="word.id"
                                    v-on:modal="modal"
                                    v-on:closeMenu="closeMenu"
                                    type="asset">
                            </tabitem>
                        </ul>
                    </section>
                </el-tab-pane>
                <el-tab-pane label="Предложения" name="sentences">
                    <section data-scrollbar>
                        <ul :class="['nav', 'nav-list']">
                            <tabitem
                                    v-for="(sentence, index) in sentences"
                                    :item="sentence"
                                    :index="index"
                                    :key="sentence.id"
                                    v-on:modal="modal"
                                    v-on:closeMenu="closeMenu"
                                    type="asset">
                            </tabitem>
                        </ul>
                    </section>
                </el-tab-pane>
                <el-tab-pane label="Мои словари" name="personal">
                    <section data-scrollbar>
                        <ul :class="['nav', 'nav-list']">
                            <tabitempersonal
                                    v-for="(personal, index) in personals"
                                    :item="personal"
                                    :index="index"
                                    :key="personal.id"
                                    v-on:closeMenu="closeMenu"
                                    type="personal">
                            </tabitempersonal>
                        </ul>
                    </section>
                </el-tab-pane>
            </el-tabs>
        </el-card>
    </el-col>
</template>

<script type="text/babel">
    import Tabitem from './tab-item.vue';
    import Tabitempersonal from './tab-item-personal.vue';
    import Scrollbar from 'smooth-scrollbar';

    export default{
        data(){
            return {}
        },
        computed: {
            personals(){
                return this.$store.getters.personal;
            },
            words(){
                return this.$store.getters.words;
            },
            sentences(){
                return this.$store.getters.sentences;
            },
            active(){
                return this.$store.getters.activeAssetType
            }
        },
        components: {
             Tabitem, Tabitempersonal
        },
        methods: {
            handleClick(tab, event) {

            },
            modal(){
                this.$emit('modal')
            },
            closeMenu(){
                this.$emit('closeMenu')
            }
        },
        mounted(){
            Scrollbar.initAll({
                alwaysShowTracks: true,
                overscrollEffect: 'bounce'
            });
        }
    }
</script>
