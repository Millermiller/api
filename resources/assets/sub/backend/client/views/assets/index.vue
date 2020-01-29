<template>
    <div class="columns">
        <div class="column is-4 asset-column">
            <div class="box">
                <b-tabs>
                    <b-tab-item label="слова">
                        <button class="button is-small" style="margin: 10px 0;" @click="addAsset(1)">Добавить</button>
                        <ul>
                            <asset v-for="word in words" :item="word" @edit="assetEdit" @remove="removeAsset"></asset>
                        </ul>
                    </b-tab-item>
                    <b-tab-item label="предложения">
                        <button class="button is-small" style="margin: 10px 0;" @click="addAsset(2)">Добавить</button>
                        <ul>
                            <asset v-for="sentence in sentences" :item="sentence" @edit="assetEdit" @remove="removeAsset"></asset>
                        </ul>
                    </b-tab-item>
                </b-tabs>
            </div>
        </div>
        <div class="column is-4 cards-column">
            <div class="box">
                <card
                        v-for="(card, index) in cards"
                        :card="card"
                        :index="index"
                        :key="card.id"
                        v-on:remove="removeCard">

                </card>
            </div>
        </div>
        <div class="column is-4 translate-column">
            <div class="box">
                <div class="block">
                    <p class="control has-addons">
                        <input class="input" type="text" placeholder="rus" v-model="text">
                        <a :class="['button', {'is-loading': searchloaded }]" @click="search">Искать</a>
                        <a :class="['button', {'is-loading': sentencesloaded }]"
                           @click="searchsentences">Предложения</a>
                    </p>
                </div>
                <div class="block">
                    <translate
                            v-for="(item, index) in translates"
                            :item="item"
                            :index="index"
                            v-on:increment="increment"
                            v-on:remove="removeTranslate">
                    </translate>
                </div>
            </div>
        </div>

        <b-modal :active.sync="isComponentModalActive" @close="close">
            <div class="box">
                <div class="translate-section">
                    <p>
                        Asset id={{editedAsset.id}} basic={{editedAsset.basic}} type={{editedAsset.type}} level={{editedAsset.level}} favorite={{editedAsset.favorite}}
                    </p>
                    <b-field>
                        <b-input type="text" placeholder="text" v-model="editedAsset.title" style="width: 380px;"></b-input>
                        <b-input type="text" placeholder="text" v-model="editedAsset.level" style="width: 80px;"></b-input>
                        <p class="control">
                            <button  class="button is-success" @click="updateTitle">Сохранить</button >
                        </p>
                        <p class="control">
                            <button  class="button is-warning" @click="close">Отмена</button >
                        </p>
                    </b-field>
                </div>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import Asset from './asset.vue'
    import Card from './card.vue'
    import Translate from './translate.vue'

    export default {
        components: {
            Asset,
            Card,
            Translate,
        },
        data () {
            return {
                words: [],
                sentences: [],
                text: '',
                translates: [],
                sentence: 0,
                searchloaded: false,
                sentencesloaded: false,
                isComponentModalActive: false,
                editedAsset: {
                    id:'',
                    basic:'',
                    type:'',
                    level:'',
                    title:'',
                }
            }
        },
        methods: {
            assetEdit(item){
                this.editedAsset = item
                this.isComponentModalActive = true
            },
            load () {
                this.$http.get('/admin/assets').then((response) => {
                    this.words = response.body.words
                    this.sentences = response.body.sentences
                }, (response) => {
                    console.log(response)
                })
            },
            removeCard (data) {
                this.$store.dispatch('removeCard', data)
                this.decrement()
            },
            removeAsset (item) {
                this.$http.delete('/asset/' + item.id).then((response) => {
                    this.load()
                }, (response) => {
                    console.log(response)
                })
            },
            addAsset (type) {
                this.$http.post('/admin/level', {asset_id: type}).then((response) => {
                    this.load()
                }, (response) => {
                    console.log(response)
                })
            },
            search () {
                if (this.text === '') return false
                this.searchloaded = true
                this.$http.get('/translate', {params: {word: this.text, sentence: +this.sentence}}).then(
                    (response) => {
                        if (!response.body.length) {
                            console.log(response.body.message)
                            this.translates = []
                            this.searchloaded = false
                        }
                        this.translates = response.body
                        this.searchloaded = false
                    },
                    (response) => {
                        console.log(response)
                    }
                )
            },
            searchsentences () {
                this.sentencesloaded = true
                this.$http.get('/admin/sentences').then(
                    (response) => {
                        this.translates = response.body
                        this.sentencesloaded = false
                    },
                    (response) => {
                        console.log(response)
                    }
                )
            },
            removeTranslate (data) {
                this.$http.delete('/admin/translate/' + data.item.id).then(
                    (response) => {
                        if (response.body.success) {
                            this.translates.splice(data.index, 1)
                        }
                    },
                    (response) => {
                        console.log(response)
                    }
                )
            },
            increment(id){
                let aid = this.$store.getters.activeAssetId

                this.words.forEach(function(item, i) {
                    if(item.id === aid)
                        item.cards_count++
                });
            },
            decrement(){
                let aid = this.$store.getters.activeAssetId

                this.words.forEach(function(item, i) {
                    if(item.id === aid)
                        item.cards_count--
                });
            },
            updateTitle () {
                this.$http.post('/admin/asset/' + this.editedAsset.id, {text: this.editedAsset.title, level: this.editedAsset.level}).then((response) => {
                    if (response.body.success) {
                        this.$snackbar.open('Обновлено')
                        this.load()
                    }
                    else{
                        this.$snackbar.open('Ошибка')
                    }
                    this.close()
                }, (response) => {
                    console.log(response)
                })
            },
            close(){
                this.isComponentModalActive = false
            }
        },
        mounted () {
            this.load()
        },
        computed: {
            cards () {
                return this.$store.getters.cards
            }
        }
    }
</script>
