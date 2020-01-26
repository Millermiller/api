<template lang="pug">
  el-col#puzzlewidget(:span=8 :xs=24)
    el-card(shadow="hover" @click.native="words()").widget-block.pointer
      p.widget-title Паззлы
      p.widget-description {{active}}/{{all}}
      el-progress(type="circle" :percentage="percent")
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { IPuzzle } from '@/models/Puzzle'
import puzzleAPI from '@/api/puzzleAPI'

  @Component({
    name: 'Puzzlewidget',
  })
export default class extends Vue {
    puzzles: IPuzzle[] = []

    words() {
      this.$router.push('/puzzle')
    }

    get percent() {
      return Math.round(100 * this.active / this.all)
    }

    get active() {
      let count = 0

      this.puzzles.forEach((element, index, array) => {
        if (element.success) count++
      })

      return count
    }

    get all() {
      return (this.puzzles.length) ? this.puzzles.length : 1
    }

    async created() {
      await puzzleAPI.getPuzzles().then((response: any) => {
        this.puzzles = response.data
      })
    }
}
</script>
