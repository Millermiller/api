<template>
  <section class="app-main">
    <div class="container is-fluid is-marginless app-content">
      <levelbar></levelbar>
      <transition
        mode="out-in"
        enter-active-class="fadeIn"
        leave-active-class="fadeOut"
        appear>
        <router-view class="animated"></router-view>
      </transition>
    </div>
  </section>
</template>

<script lang="ts">
import Component from 'vue-class-component'
import Vue from 'vue'
import Levelbar from '@/components/Levelbar.vue'

  @Component({
    name: 'AppMain',
    components: {
      Levelbar,
    },

  })
export default class extends Vue {

}
</script>

<style lang="scss">

  .app-main {
    padding-top: 50px;
    margin-left: 180px;
    transform: translate3d(0, 0, 0);

  }

  .app-content {
    padding: 20px;
  }
</style>
