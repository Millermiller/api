<template lang="pug">
  el-col#textwidget(:span=8 :xs=24)
    el-card(shadow='hover' @click.native='text()').widget-block.pointer
      p.widget-title Тексты
      p.widget-description {{active}}/{{all}}
      el-progress(type='circle' :percentage='percent')
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

  @Component({
    name: 'Textwidget',
  })
export default class extends Vue {
    active: number = 0

    all: number = 1

    get percent() {
      return Math.round(100 * this.active / this.all)
    }

    text() {
      this.$router.push('/translates')
    }

    created() {
      setTimeout(() => {
        this.active = this.$store.getters.activeTexts
        this.all = this.$store.getters.texts.length
      }, 500)
    }
}
</script>
