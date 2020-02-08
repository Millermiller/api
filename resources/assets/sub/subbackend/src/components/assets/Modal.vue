<template>
  <b-modal :active.sync="visible" @close="close" :width="960" class="w960">
    <div class="box">
      <div class="header">{{card.id}} - {{card.word.word}}</div>
      <div class="translate-section">
        <p class="control">
          <input class="input" type="text" placeholder="text" v-model="text" :value="card.word.word"
                 style="width: 490px;">
        </p>
        <hr>
        <div class="variants">
          <h2 class="subtitle is-5">Варианты перевода:</h2>
          <ul>
            <li v-for="word in values"
                @click="setActive(word)"
                :class="['variant', {'is-success': word.active }]">
              {{word.value}}
            </li>
          </ul>
        </div>
      </div>
      <hr>
      <div class="example-section">
        <h2 class="subtitle is-5">
          Примеры:
          <button class="colorbutton red" @click="color('#e13c4c')"></button>
          #e13c4c
          <button class="colorbutton green" @click="color('#4c7737')"></button>
          #4c7737
          <button class="colorbutton blue" @click="color('#3f4bb8')"></button>
          #3f4bb8
          <span @click="addExample" class="button is-success pull-right">добавить</span>
        </h2>
        <div>
          <example
            v-for="(item, index) in examples"
            :item="item"
            :index="index"
            :key="item.id"
            v-on:remove="removeExample"
          >
          </example>
        </div>
      </div>
      <hr>
      <div class="audio-section">
        <audio ref="audio" :src="card.word.audio" preload="auto"></audio>
        <a :class="['button', 'is-small']" @click="play">
                    <span class="icon">
                          <i class="fa fa-volume-up"></i>
                    </span>
        </a>

        <form enctype="multipart/form-data" action="" method="post" name="addAudio" ref="audioform">
          <input type="file" name="audiofile" @change="bindFile"/>
          <a class="button is-success" @click="updateAudio">Загрузить аудио</a>
          <a class="button is-success" @click="updateTranslate">Сохранить</a>
          <a class="button is-warning" @click="close">Отмена</a>
        </form>
      </div>
    </div>
  </b-modal>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

import { Prop, Watch } from 'vue-property-decorator'
import Example from '@/components/assets/Modal_example.vue'
import assetAPI from '@/api/assetAPI'

  @Component({
    name: 'Modal',
    components: {
      Example,
    },
  })
export default class extends Vue {
    @Prop({ required: true })
    private visible!: any

    @Prop({ required: true })
    private card!: any

    @Prop({ required: true })
    private index!: any

    private fileUploadFormData: FormData = new FormData()
    private text: string = ''
    private values: any[] = []
    private examples: any[] = []

    bindFile(e: any) {
      e.preventDefault()
      this.fileUploadFormData.append('audiofile', e.target.files[0])
      this.fileUploadFormData.append('id', this.card.word.id)
    }

    close() {
      this.$emit('close')
    }

    updateAudio() {
      assetAPI.updateAudio(this.fileUploadFormData).then((response) => {
        if (response.data.success) {
          this.$store.commit('changeAssetAudio', { index: this.index, url: response.data.url })
          this.close()
        }
      }, (response) => {
        console.log(response)
      })
    }

    updateTranslate() {
      assetAPI.translate({
        card_id: this.card.id,
        id: this.card.translate.id,
        text: this.text,
        examples: this.examples,
      }).then((response) => {
        if (response.data.success) {
          this.$store.commit('changeAssetWord', { index: this.index, text: this.text })
        }
        this.close()
      }, (response) => {
        console.log(response)
      })
    }

    setActive(word: any) {
      assetAPI.changeUsedTranslate({
        card_id: this.card.id,
        word_id: this.card.word.id,
        translate_id: word.id,
      }).then((response) => {
        if (response.data.success) {
          this.text = word.value
          for (const value of this.values) {
            if (value !== 0) {
              value.active = false
            }
          }
          word.active = true
          this.$store.commit('changeAssetTranslate', { index: this.index, translate: word })
          this.close()
        }
      }, (response) => {
        console.log(response)
      })
    }

    play() {
      // @ts-ignore
      this.$refs.audio.play()
    }

    addExample() {
      this.examples.push({ text: '', value: '' })
    }

    removeExample(i: any) {
      this.examples.splice(i, 1)
    }

    @Watch('visible')
    private onChange(val: any) {
      if (val) {
        assetAPI.getValues(this.card).then((response) => {
          this.values = response.data.values
          for (const v in this.values) {
            if (this.values[v].id === this.card.translate_id) {
              this.values[v].active = true
            }
          }
        }, (response) => {
          console.log(response)
        })
        assetAPI.getExamples(this.card).then((response) => {
          this.examples = response.data.values
        }, (response) => {
          console.log(response)
        })
      }
    }

    mounted() {
      this.text = (this.card.translate) ? this.card.translate.value : ''
    }
}
</script>
