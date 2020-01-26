<template lang="pug">
  el-col#personalwidget(:span=8 :xs=24)
    el-card(shadow='hover' @click.native='personal()').widget-block.personal-widget-block.pointer
      p.widget-title Мои словари
      p.widget-description {{all}}
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

  @Component({
    name: 'Personalwidget',
  })
export default class extends Vue {
  get all() {
    return this.$store.getters.personal.length
  }

  personal() {
    this.$router.push('/cards')
  }
}
</script>
