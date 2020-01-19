<template>
    <el-col :span="8" :xs="24" :class="['right-panel']" id="cardsblock">
        <el-card :class="['box-card', 'tab-navigation']">
            <el-tabs :value="active" @tab-click="handleClick">
                <el-tab-pane label="Слова" name="words">
                    <section data-scrollbar>
                        <div class="steps-wrapper">
                            <tabitem
                                    v-for="(word, index) in words"
                                    :item="word"
                                    :index="index"
                                    :key="word.id"
                                    type="asset">
                            </tabitem>
                        </div>
                    </section>
                </el-tab-pane>
                <el-tab-pane label="Предложения" name="sentences">
                    <section data-scrollbar>
                        <div class="steps-wrapper">
                            <tabitem
                                    v-for="(sentence, index) in sentences"
                                    :item="sentence"
                                    :index="index"
                                    :key="sentence.id"
                                    type="asset">
                            </tabitem>
                        </div>
                    </section>
                </el-tab-pane>
                <el-tab-pane label="Мои словари" name="personal">
                    <section data-scrollbar>
                        <div class="steps-wrapper">
                            <tabitempersonal
                                    v-for="(personal, index) in personals"
                                    :item="personal"
                                    :index="index"
                                    :key="personal.id"
                                    type="personal">
                            </tabitempersonal>
                        </div>
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
            return {
                activeName: 'first',
            }
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
            'tabitem': Tabitem, Tabitempersonal
        },
        methods: {
            handleClick(tab, event) {

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
