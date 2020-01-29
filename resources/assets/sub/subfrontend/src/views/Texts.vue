<template>
  <el-container>
    <el-main>
      <el-row :gutter="20">
        <textcard v-for="text in texts" :text="text" :key="text.id"/>
      </el-row>
    </el-main>
  </el-container>
</template>

<script lang="ts">
import Component from 'vue-class-component';
import Vue from 'vue';
import Textcard from '@/components/textpage/Textcard.vue'

  @Component({
    name: 'TextPage',
    components: {
      Textcard,
    },
  })
export default class extends Vue {
    metaInfo: any = { title: 'Переводы' }

    get texts() {
      return this.$store.getters.texts
    }
}
</script>
