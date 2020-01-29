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

<script lang="ts">
import Vue from 'vue';
import Component from 'vue-class-component';
import Assets from '@/components/cardspage/Assets.vue'
import Dictionary from '@/components/cardspage/Dictionary.vue'
import Cards from '@/components/cardspage/Cards.vue'
import assetAPI from '@/api/assetAPI';
import IWord from '@/models/Word';
import { ITranslate } from '@/models/Translate';
import { IAsset } from '@/models/Asset';
import cardAPI from '@/api/cardAPI';

  @Component({
    name: 'CardsPage',
    components: {
      Assets,
      Cards,
      Dictionary,
    },
  })
export default class extends Vue {
    cards: [] = []

    name: string = ''

    loading: boolean = false

    metaInfo = {
      title: 'Мои словари',
    }

    created() {
      this.$eventHub.$on('assetSelect', this.load);
      this.$eventHub.$on('addCardToAsset', this.add);
    }

    load(id: number) {
      this.loading = true
      assetAPI.getAsset(id).then((response) => {
        if (response.data.success === false) {
          this.$notify.error({
            title: 'Ошибка',
            message: response.data.message,
            duration: 4000,
          });
        } else {
          this.cards = response.data.cards
          this.name = response.data.title
          this.loading = false
        }
      }, (response) => {
        console.log(response);
      });
    }

    add(word: IWord, translate: ITranslate, asset: IAsset) {
      this.loading = true
      cardAPI.createCard(word, translate, asset).then(
        (response) => {
          if (response.status === 201) {
            this.$notify.success({
              title: 'Карточка добавлена',
              message: word.word,
              duration: 4000,
            });
            this.$store.commit('addCard', asset.id)
            this.load(asset.id)
          }
        },
        (response) => {
          console.log(response);
        },
      )
    }

    get show() {
      return this.$store.getters.showDictionary
    }

    mounted() {
      this.$store.dispatch('onCardsPageOpen')
      this.load(this.$store.getters.activeAsset)
    }

    beforeDestroy() {
      this.$store.dispatch('onCardsPageClose')
      this.$eventHub.$off('assetSelect');
      this.$eventHub.$off('deleteCardFromAsset');
      this.$eventHub.$off('addCardToAsset');
    }
}
</script>
