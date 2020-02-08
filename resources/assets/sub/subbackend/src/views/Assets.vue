<template>
  <div class="columns">
    <div class="column is-4 asset-column">
      <div class="box">
        <b-tabs>
          <b-tab-item label="слова">
            <button class="button is-small" style="margin: 10px 0;" @click="addAsset(1)">Добавить
            </button>
            <ul>
              <asset v-for="word in words" :item="word" @edit="assetEdit"
                     @remove="removeAsset"></asset>
            </ul>
          </b-tab-item>
          <b-tab-item label="предложения">
            <button class="button is-small" style="margin: 10px 0;" @click="addAsset(2)">Добавить
            </button>
            <ul>
              <asset v-for="sentence in sentences" :item="sentence" @edit="assetEdit"
                     @remove="removeAsset"></asset>
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
            Asset id={{editedAsset.id}} basic={{editedAsset.basic}} type={{editedAsset.type}}
            level={{editedAsset.level}} favorite={{editedAsset.favorite}}
          </p>
          <b-field>
            <b-input type="text" placeholder="text" v-model="editedAsset.title"
                     style="width: 380px;"></b-input>
            <b-input type="text" placeholder="text" v-model="editedAsset.level"
                     style="width: 80px;"></b-input>
            <p class="control">
              <button class="button is-success" @click="updateTitle">Сохранить</button>
            </p>
            <p class="control">
              <button class="button is-warning" @click="close">Отмена</button>
            </p>
          </b-field>
        </div>
      </div>
    </b-modal>
  </div>
</template>

<script lang="ts">
import Component from 'vue-class-component'
import Vue from 'vue'
import Asset from '@/components/assets/Asset.vue'
import Card from '@/components/assets/Card.vue'
import Translate from '@/components/assets/Translate.vue'
import assetAPI from "@/api/assetAPI"

  @Component({
    name: 'AssetsView',
    components: {
      Asset,
      Card,
      Translate,
    },
  })
export default class extends Vue {
    private words: [] = []
    private sentences: [] = []
    private text: string = ''
    private translates: [] = []
    private sentence: number = 0
    private searchloaded: boolean = false
    private sentencesloaded: boolean = false
    private isComponentModalActive: boolean = false
    private editedAsset: any = {
      id: '',
      basic: '',
      type: '',
      level: '',
      title: '',
    }

    assetEdit(item: any) {
      this.editedAsset = item
      this.isComponentModalActive = true
    }

    load() {
      assetAPI.getAssets().then((response) => {
        this.words = response.data.words
        this.sentences = response.data.sentences
      }, (response) => {
        console.log(response)
      })
    }

    removeCard(data: any) {
      this.$store.dispatch('removeCard', data)
      this.decrement()
    }

    removeAsset(item: any) {
      assetAPI.destroyAsset(item.id).then((response) => {
        this.load()
      }, (response) => {
        console.log(response)
      })
    }

    addAsset(type: any) {
      assetAPI.addAsset(type).then((response) => {
        this.load()
      }, (response) => {
        console.log(response)
      })
    }

    search() {
      if (this.text === '') return false
      this.searchloaded = true
      assetAPI.getTranslate(this.text, this.sentence).then(
        (response) => {
          if (!response.data.length) {
            console.log(response.data.message)
            this.translates = []
            this.searchloaded = false
          }
          this.translates = response.data
          this.searchloaded = false
        },
        (response) => {
          console.log(response)
        },
      )
    }

    searchsentences() {
      this.sentencesloaded = true
      assetAPI.sentences().then(
        (response) => {
          this.translates = response.data
          this.sentencesloaded = false
        },
        (response) => {
          console.log(response)
        },
      )
    }

    removeTranslate(data: any) {
      assetAPI.removeTranslate(data.item.id).then(
        (response) => {
          if (response.data.success) {
            this.translates.splice(data.index, 1)
          }
        },
        (response) => {
          console.log(response)
        },
      )
    }

    increment(id: any) {
      const aid = this.$store.getters.activeAssetId

      this.words.forEach((item: any, i) => {
        if (item.id === aid) item.cards_count++
      })
    }

    decrement() {
      const aid = this.$store.getters.activeAssetId

      this.words.forEach((item: any, i) => {
        if (item.id === aid) item.cards_count--
      })
    }

    updateTitle() {
      assetAPI.updateTitle(this.editedAsset.id,{
        text: this.editedAsset.title,
        level: this.editedAsset.level,
      }).then((response) => {
        if (response.data.success) {
          this.$snackbar.open('Обновлено')
          this.load()
        } else {
          this.$snackbar.open('Ошибка')
        }
        this.close()
      }, (response) => {
        console.log(response)
      })
    }

    close() {
      this.isComponentModalActive = false
    }

    mounted() {
      this.load()
    }

    get cards() {
      return this.$store.getters.cards
    }
}
</script>
