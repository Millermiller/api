<template lang="pug">
  el-col#wordwidget(:span=8 :xs=24)
    el-card(shadow="hover" @click.native='words()').widget-block.pointer
      p.widget-title Слова
      p.widget-description {{this.active}}/{{this.all}}
      el-progress(type="circle" :percentage="percent")
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

  @Component({
    name: 'Wordwidget',
  })
export default class extends Vue {
    active: number = 0
    all: number = 1

    words() {
      this.$router.push('/learn')
    }

    get percent() {
      return Math.round(100 * this.active / this.all)
    }

    created() {
      setTimeout(() => {
        this.active = this.$store.getters.activeWords
        this.all = this.$store.getters.words.length
      }, 500)
    }
}
</script>
