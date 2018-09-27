<template>
    <el-container>
        <el-main>
            <el-row :gutter="20">
                <assets></assets>
                <cards v-if="show"></cards>
                <dictionary v-if="show"></dictionary>
            </el-row>
        </el-main>
    </el-container>
</template>

<script>
    import Assets from './assets.vue'
    import Cards from './cards.vue'
    import Dictionary from './dictionary.vue'
    import introJs from 'intro.js/intro'

    export default{
        metaInfo: {
            title: 'Мои словари',
        },
        components: {
            'assets': Assets,
            'cards': Cards,
            'dictionary': Dictionary,
        },
        created(){

        },
        computed: {
            show(){
                return this.$store.getters.showDictionary
            }
        },
        mounted(){
            this.$store.dispatch('onCardsPageOpen')

            let intr = introJs.introJs()

            intr.setOptions({
                steps: this.$store.getters.intro('/cards'),
                showStepNumbers: false,
                nextLabel: 'Вперед &rarr;',
                prevLabel: '&larr; Назад',
                skipLabel: 'Пропустить',
                doneLabel: 'Завершить'
            })
                .start()
        },
        beforeDestroy(){
            this.$store.dispatch('onCardsPageClose')
        }
    }
</script>