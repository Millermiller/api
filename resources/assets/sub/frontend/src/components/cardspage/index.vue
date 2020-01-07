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
    import store from "../../store";

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
            this.$eventHub.$on('addCardToAsset', this.add);
        },
        methods:{
            load(id){
                this.loading = true
                this.$http.get('/asset/' + id).then((response) => {
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
            add(data){
                this.loading = true
                this.$http.post('/card/' + data.word.id + '/' + data.translate_id + '/' + data.asset_id).then(
                    (response) => {
                        if(response.status === 201){
                            this.$notify.success({
                                title: 'Карточка добавлена',
                                message: data.word.word,
                                duration: 4000
                            });
                            this.$store.commit('addCard', data.asset_id)
                            this.load(data.asset_id)
                        }
                    },
                    (response) => {
                        console.log(response);
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

            this.load(this.$store.getters.activeAsset)

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
            this.$eventHub.$off('addCardToAsset');
        }
    }
</script>