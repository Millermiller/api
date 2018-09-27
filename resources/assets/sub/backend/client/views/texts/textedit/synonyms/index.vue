<template>
    <div>
        <div class="columns">
            <div class="column is-12">
                <b-tabs>
                    <template v-for="(sentence, index) in sentences">
                        <b-tab-item
                                :label="index.toString()"
                                :selected="index == 0">
                            <div class="">
                                <span
                                        :class="['tag',  word.id == wordId ? 'is-success' : '']"
                                        style="cursor: pointer"
                                        @click="setActive(word)"
                                        v-for="(word, index) in sentence">
                                    {{word.word}}&nbsp;
                                </span>
                            </div>
                        </b-tab-item>
                    </template>
                </b-tabs>
                <hr>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <p class="control is-expanded has-addons">
                    <a :class="['button', 'is-success']" @click="add">Добавить синоним</a>
                    <input class="input" type="text" v-model="newSynonym" :placeholder="activePlaceholder">
                </p>
            </div>
        </div>
        <div class="columns is-multiline">
            <div class="column">
                <template v-for="(synonym, index) in synonyms">
                    <p class="control is-expanded has-addons">
                        <a class="button">{{synonym.synonym}}</a>
                        <a :class="['button', 'is-danger']" @click="remove(synonym.id)">
                                <span class="icon">
                                      <i class="fa fa-trash-o"></i>
                                </span>
                        </a>
                    </p>
                </template>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return {
                synonyms: [],
                wordId: 0,
                newSynonym: '',
                activePlaceholder: ''
            }
        },
        props: ['sentences'],
        methods: {
            setActive(word){
                this.activePlaceholder = word.word
                this.load(word.id)
                this.newSynonym = ''
            },
            load(id){
                this.$http.get('/admin/text/synonyms/' + id).then((response) => {
                    if (response.body.success) {
                        this.synonyms = response.body.synonyms
                        this.wordId = id
                    }
                }, (response) => {
                    console.log(response)
                })
            },
            add(){
                this.$http.post('/admin/text/synonym', {
                    word_id: this.wordId,
                    synonym: this.newSynonym
                }).then((response) => {
                    if (response.body.success) {
                        this.load(this.wordId)
                    }
                }, (response) => {
                    console.log(response)
                })
            },
            remove(id){
                this.$http.delete('/admin/text/synonym/' + id).then((response) => {
                    if (response.body.success) {
                        this.load(this.wordId)
                    }
                }, (response) => {
                    console.log(response)
                })
            }
        }
    }
</script>