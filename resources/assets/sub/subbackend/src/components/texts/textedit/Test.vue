<template>
  <div class="columns">
    <div class="column is-6">
      <div class="tile is-child box" style="position: relative;">
        <vue-progress-bar></vue-progress-bar>
        <p v-html="output" class="content"></p>
        <div>
          <template v-for="extra in extras">
            <div class="col-md-6">
              <p class="pointer">
                                <span v-on:mouseover="showExtra(extra)"
                                      v-on:mouseout="clearExtra">{{extra.orig}}</span> -
                {{extra.extra}}
              </p>
            </div>
          </template>
        </div>
      </div>
    </div>
    <div class="column is-6">
                <textarea
                  style="height: 280px; width: 100%;"
                  class="tile is-parent content"
                  id="transarea"
                  placeholder="Поле для перевода"
                  v-model="input"
                  v-on:input="separate"
                ></textarea>
      <button @click="clear" class="button is-primary">Очистить</button>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator'

@Component({
  name: 'Test',
})
export default class extends Vue {
    @Prop({ required: true })
    private textdata!: any

    @Prop({ required: true })
    private dictionary!: any

    @Prop({ required: true })
    private extras!: any

    @Prop({ required: true })
    private cleartext!: any

    private input: string = ''
    private inputWords: any[] = []
    private showedExtra: string = ''
    private showSuccess: boolean = false
    private progress: number = 0
    private nextTextId: number = 0
    private dictionaryLength: number = 0

    get output() {
      let c = 0
      let origs: any[] = []
      this.dictionaryLength = this.dictionary.length
      this.textdata.computed = this.cleartext

      this.inputWords.forEach((el: any) => {
        el = el.toLowerCase()
        if (el !== '' && el in this.dictionary) origs = origs.concat(this.dictionary[el].map((item: any) => `${item}|${el}`))
      })

      origs = origs.filter((v, i, a) => a.indexOf(v) === i)

      for (let i = 0; i < origs.length; i++) {
        const arr = origs[i].split('|')
        const word = arr[0].replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&')
        const tooltip = arr[1]

        this.textdata.computed = this.textdata.computed.replace(
          new RegExp(`(^|\\s)(${word.trim()})([^\\w]|$)`, 'gi'),
          `$1<span class="tag is-success" tooltip=${tooltip}>$2</span>$3`,
        )
        c++
      }

      if (this.showedExtra != '') {
        this.textdata.computed = this.textdata.computed.replace(
          new RegExp(`(^|\\s|>)(${this.showedExtra.trim()})([^\\w]|$|<)`, 'gi'),
          '$1<span class="extra">$2</span>$3',
        )
      }

      this.progress = Math.floor((c * 100) / this.textdata.words_count)

      this.$Progress.set(this.progress)

      if (this.progress > 99) this.showSuccess = true

      return this.textdata.computed
    }

    separate() {
      this.inputWords = this.input.replace(/\s+/g, ' ').replace(/\./g, '').replace(/\,/g, '').trim()
        .split(' ')
    }

    showExtra(extra: any) {
      this.showedExtra = extra.orig
    }

    clearExtra() {
      this.showedExtra = ''
    }

    clear() {
      this.input = ''
      this.inputWords = []
      this.progress = 0
    }

    gotonext() {
      this.$router.push(`/translates/${this.nextTextId}`)
    }
}
</script>
