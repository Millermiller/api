<template>
    <div>
        <div class="columns">
            <div class="column is-12 content">
                {{cleartext}}
            </div>
        </div>
        <div class="columns">
            <div class="column is-12">
                <b-tabs>
                    <template v-for="(sentence, index) in sentences">
                        <b-tab-item
                                :label="index.toString()"
                                :selected="index == 0">
                            <div class="columns is-multiline" style="padding-top: 10px;">
                                <item
                                        v-for="(word, index) in sentence"
                                        :word="word"
                                        :index="index"
                                        @remove="removeWord"
                                        @add="addWord"></item>
                            </div>
                        </b-tab-item>
                    </template>
                </b-tabs>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <button class="button is-primary" @click="$emit('update')">Сохранить</button>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

import { Prop } from 'vue-property-decorator'
import Item from '@/components/texts/textedit/translate/item.vue'

@Component({
  name: 'Index',
  components: {
    Item,
  },
})
export default class extends Vue {
  @Prop({ required: true })
  private text!: any
  @Prop({ required: true })
  private cleartext!: any
  @Prop({ required: true })
  private sentences!: any

  removeWord(data: any) {
    this.sentences[data.word.sentence_num].splice(data.index, 1)
  }
  addWord(data: any) {
    this.sentences[data.word.sentence_num].splice(data.index + 1, 0,
      {
        orig: '',
        sentence_num: data.word.sentence_num,
        text_id: data.word.text_id,
        word: '',
      })
  }
}
</script>
