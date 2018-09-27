<template>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-parent is-12">
                <div class="tile is-child box">
                    <div class="block is-flex">
                        <b-tabs>
                            <b-tab-item label="Tooltips" selected>
                                <tooltips :item="text" :extras="extras" :sentences="sentences"
                                          @update="updateTooltips"></tooltips>
                            </b-tab-item>
                            <b-tab-item label="Перевод">
                                <translate :text="text" :cleartext="cleartext" :sentences="sentences"
                                           @update="updateSentences"></translate>
                            </b-tab-item>
                            <b-tab-item label="Синонимы">
                                <synonyms :sentences="sentences"></synonyms>
                            </b-tab-item>
                            <b-tab-item label="Изображение">
                                <images :item="text"></images>
                            </b-tab-item>
                            <b-tab-item label="Описание">
                                <description :item="text"></description>
                            </b-tab-item>
                            <b-tab-item label="Тест">
                                <test :textdata="text" :dictionary="dictionary" :extras="extras"
                                      :cleartext="cleartext"></test>
                            </b-tab-item>
                        </b-tabs>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Tooltips from './tooltips.vue'
    import Translate from './translate/index.vue'
    import Synonyms from './synonyms/index.vue'
    import Images from './image/index.vue'
    import Description from './description/index.vue'
    import Test from './test.vue'

    export default {
        components: {
            Tooltips,
            Translate,
            Synonyms,
            Images,
            Description,
            Test
        },
        data () {
            return {
                text: {},
                cleartext: '',
                extras: {},
                dictionary: [],
                sentences: []
            }
        },
        methods: {
            load(id){
                this.$http.get('/admin/text/' + id).then((response) => {
                    if (response.body.success) {
                        this.text = response.body.text
                        this.cleartext = response.body.cleartext
                        this.extras = response.body.extras
                        this.dictionary = response.body.synonyms
                        this.sentences = response.body.sentences
                    } else {
                        //
                    }
                }, (response) => {
                    console.log(response)
                })
            },
            updateTooltips(){
                this.$http.post('/admin/text/extra', {text_id: this.text.id, data: this.extras}).then((response) => {
                    if (response.body.success) {
                        this.load(this.text.id)
                    }
                }, (response) => {
                    console.log(response)
                })
            },
            updateSentences(){
                this.$http.post('/admin/text/sentences', {
                    text_id: this.text.id,
                    data: this.sentences
                }).then((response) => {
                    if (response.body.success) {
                        this.load(this.text.id)
                    }
                }, (response) => {
                    console.log(response)
                })
            }
        },
        mounted(){
            this.load(this.$route.params.id)
        }
    }
</script>