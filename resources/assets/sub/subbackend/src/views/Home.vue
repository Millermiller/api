<template>
  <div class="content has-text-centered">
    <p>
      <img width="200" src="~assets/logo.png" :alt="description">
    </p>

    <h1 class="is-title is-bold">{{ name.replace('-', ' ') }}</h1>

    <p>
      <strong>{{ description }}</strong>,
      <a :href="homepage">Live Demo</a>
    </p>

    <p>Supports Vue 2.0 and Bulma 0.3!</p>
  </div>
</template>

<script lang="ts">
import Component from 'vue-class-component'
import Vue from 'vue'
import Asset from '@/components/assets/Asset.vue'
import Card from '@/components/assets/Card.vue'
import Translate from '@/components/assets/Translate.vue'

  @Component({
    name: 'HomeView',
    components: {
      Asset,
      Card,
      Translate,
    },
  })
export default class extends Vue {
  // this.$store.state.pkg
}
</script>
