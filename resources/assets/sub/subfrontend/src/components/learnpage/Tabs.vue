<template>
  <el-col :span="8" :xs="{span: 24, offset: 0}" :class="['right-panel']" :id="['cardsblock']">
    <el-card :class="['box-card', 'tab-navigation']">
      <el-tabs @tab-click="handleClick" :value="active">
        <el-tab-pane label="Слова" name="words">
          <section data-scrollbar>
            <ul :class="['nav', 'nav-list']">
              <tabitem
                v-for="(word, index) in words"
                :item="word"
                :index="index"
                :key="word.id"
                type="asset">
              </tabitem>
            </ul>
          </section>
        </el-tab-pane>
        <el-tab-pane label="Предложения" name="sentences">
          <section data-scrollbar>
            <ul :class="['nav', 'nav-list']">
              <tabitem
                v-for="(sentence, index) in sentences"
                :item="sentence"
                :index="index"
                :key="sentence.id"
                type="asset">
              </tabitem>
            </ul>
          </section>
        </el-tab-pane>
        <el-tab-pane label="Мои словари" name="personal">
          <section data-scrollbar>
            <ul :class="['nav', 'nav-list']">
              <tabitempersonal
                v-for="(personal, index) in personals"
                :item="personal"
                :index="index"
                :key="personal.id"
                type="personal">
              </tabitempersonal>
            </ul>
          </section>
        </el-tab-pane>
      </el-tabs>
    </el-card>
  </el-col>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import Scrollbar from 'smooth-scrollbar'
import Tabitem from '@/components/learnpage/TabItem.vue'
import Tabitempersonal from '@/components/learnpage/TabItemPersonal.vue'

  @Component({
    name: 'Tabs',
    components: {
      Tabitem, Tabitempersonal,
    },
    mounted() {
      Scrollbar.initAll({
        alwaysShowTracks: true,
        //  overscrollEffect: 'bounce',
      })
    },
  })
export default class extends Vue {
  get personals() {
    return this.$store.getters.personal
  }

  get words() {
    return this.$store.getters.words
  }

  get sentences() {
    return this.$store.getters.sentences
  }

  get active() {
    return this.$store.getters.activeAssetType
  }

    handleClick = () => {
      //
    }
}
</script>
