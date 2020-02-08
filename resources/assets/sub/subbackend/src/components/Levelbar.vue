<template>
  <nav class="level app-levelbar">
    <div class="level-left">
      <div class="level-item">
        <h3 class="subtitle is-5">
          <strong>{{ name }}</strong>
        </h3>
      </div>
    </div>

    <div class="level-right is-hidden-mobile">
      <breadcrumb :list="list"></breadcrumb>
    </div>
  </nav>
</template>

<script lang="ts">
  import Breadcrumb from 'vue-bulma-breadcrumb'
  import Component from "vue-class-component"
  import Vue from "vue"

  @Component({
    name: 'LevelBar',
    components: {
      Breadcrumb
    },
  })
  export default class extends Vue {

    data() {
      return {
        list: null,
      }
    },

    created() {
      this.getList()
    },

    computed: {
      codelink() {
        if (this.$route.meta && this.$route.meta.link) {
          return 'https://github.com/vue-bulma/vue-admin/blob/master/client/views/' +
            this.$route.meta.link
        } else {
          return null
        }
      },
      name() {
        return this.$route.name
      },
    },

    methods: {
      getList() {
        let matched = this.$route.matched.filter(item => item.name)
        let first = matched[0]
        if (first && (first.name !== 'Home' || first.path !== '')) {
          matched = [
            {
              name: 'Home',
              path: '/',
            }].concat(matched)
        }
        this.list = matched
      },
    },

    watch: {
      $route() {
        this.getList()
      },
    },
  }
</script>
