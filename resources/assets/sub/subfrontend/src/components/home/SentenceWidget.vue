<template lang="pug">
  el-col#sentencewidget(:span=8 :xs=8)
    el-card(shadow='hover' @click.native='sentences()').widget-block.pointer
      p.widget-title Предложения
      p.widget-description {{active}}/{{all}}
      el-progress(type='circle', :percentage='percent')
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

  @Component({
    name: 'Sentencewidget',
  })
export default class extends Vue {
    active: number = 0

    all: number = 1

    get percent() {
      return Math.round(100 * this.active / this.all)
    }

    sentences() {
      this.$store.dispatch('setActiveAssetType', 2)
      this.$router.push('/learn')
    }

    created() {
      setTimeout(() => {
        this.active = this.$store.getters.activeSentences
        this.all = this.$store.getters.sentences.length
      }, 500)
    }
}
</script>
