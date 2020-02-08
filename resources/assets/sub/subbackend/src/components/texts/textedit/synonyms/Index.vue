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

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator'
import textAPI from "@/api/textAPI"

@Component({
  name: 'Index',
})
export default class extends Vue {
  @Prop({ required: true })
  private sentences!: any

  private synonyms: [] = []
  private wordId: number = 0
  private newSynonym: string = ''
  private activePlaceholder: string = ''


  setActive(word: any) {
    this.activePlaceholder = word.word
    this.load(word.id)
    this.newSynonym = ''
  }
  load(id: number) {
    textAPI.getSynonyms(id).then((response) => {
      if (response.data.success) {
        this.synonyms = response.data.synonyms
        this.wordId = id
      }
    }, (response) => {
      console.log(response)
    })
  }
  add() {
    textAPI.addSynonym({
      word_id: this.wordId,
      synonym: this.newSynonym,
    }).then((response) => {
      if (response.data.success) {
        this.load(this.wordId)
      }
    }, (response) => {
      console.log(response)
    })
  }
  remove(id:number) {
    textAPI.deleteSynonym(id).then((response) => {
      if (response.data.success) {
        this.load(this.wordId)
      }
    }, (response) => {
      console.log(response)
    })
  }
}
</script>
