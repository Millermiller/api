<template>
    <el-container>
        <el-main>
            <el-row :gutter="20">
                <assets/>
                <cards v-if="show" :cards="cards" :name="name" :loading="loading"/>
                <dictionary v-if="show"/>
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
        data(){
            return {
                cards: [],
                name: '',
                loading: false
            }
        },
        metaInfo: {
            title: 'Мои словари',
        },
        components: {
            'assets': Assets,
            'cards': Cards,
            'dictionary': Dictionary,
        },
        created() {
            this.$eventHub.$on('assetSelect', this.load);
            this.$eventHub.$on('deleteCardFromAsset', this.removeCard);
        },
        methods:{
            load(asset){
                this.loading = true
                this.$http.get('/asset/' + asset.id).then((response) => {
                    if(response.body.success === false){
                        this.$notify.error({
                            title: 'Ошибка',
                            message: response.body.message,
                            duration: 4000
                        });
                    }
                    else{
                        this.cards = response.body.cards
                        this.name = response.body.title
                        this.loading = false
                    }
                }, (response) => {
                    console.log(response);
                });
            },
            removeCard(data){
                this.$http.delete('/card/' + data.card.id).then(
                    (response) => {
                        if(response.status === 204)
                            this.cards.splice(data.index, 1)
                    },
                    (response) => {
                        console.log(response.body)
                    }
                )
            },
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
            this.$eventHub.$off('assetSelect');
            this.$eventHub.$off('deleteCardFromAsset');
        }
    }
</script>