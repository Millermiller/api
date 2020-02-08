<template>
  <div class="tile is-parent">
    <article class="tile is-child box">
      <div v-if="loading" id="nprogress">
        <div class="spinner-icon"></div>
      </div>
      <p class="title">{{words}}</p>
      <p class="subtitle">Слов</p>
    </article>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

  @Component({
    name: 'Words',
  })
export default class extends Vue {
    private count: number = 0
    private loading: boolean = false
}
</script>
