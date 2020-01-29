<template>
  <el-col :span="8" :class="['hidden-sm-and-down']">
    <el-card :class="['box-card', 'result-card']">
      <div slot="header" class="clearfix" id="infoblock">
        <el-row :gutter="20">
          <el-col :span="8" class="diagram">
            <el-progress type="circle" :percentage="percent" :width="100"/>
          </el-col>
          <el-col :span="16" class="asset-info">
            <template v-if="title">
              <p v-if="level > 0">{{level}} уровень</p>
              <p> вопросов: {{quantity}}</p>
              <p>Лучший результат: {{result}}%</p>
            </template>
          </el-col>
        </el-row>
      </div>
      <section data-scrollbar style="height: 55vh;overflow: hidden" id="errorsblock">
        <transition-group name="splash" tag="div">
          <ErrorItem
            v-for="(error, index) in errors"
            :item="error"
            :index="index"
            :key="index"
            class="splash-item"/>
        </transition-group>
      </section>
    </el-card>
  </el-col>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import Scrollbar from 'smooth-scrollbar'
import ErrorItem from '@/components/testpage/ErrorItem.vue'

  @Component
  @Component({
    name: 'Result',
    components: {
      ErrorItem,
    },
    mounted() {
      Scrollbar.initAll({
        alwaysShowTracks: true,
        //  overscrollEffect: 'bounce',
      })
    },
  })
export default class extends Vue {
  created() {
    this.$eventHub.$on('removeErrorItem', this.removeErrorItem)
  }

  get percent() {
    return this.$store.getters.percent
  }

  get quantity() {
    return this.$store.getters.quantity
  }

  get errors() {
    return this.$store.getters.errors
  }

  get title() {
    return this.$store.getters.title
  }

  get result() {
    return this.$store.getters.result
  }

  get level() {
    return this.$store.getters.level
  }

  removeErrorItem(id: number) {
    this.$store.commit('removeError', id)
  }

  beforeDestroy() {
    this.$eventHub.$off('removeErrorItem')
  }
}
</script>
