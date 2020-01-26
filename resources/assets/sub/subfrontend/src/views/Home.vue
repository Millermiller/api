<template>
  <el-container>
    <el-main>
      <el-row :gutter="20">

        <!--  <wordsblock v-on:modal="modal"></wordsblock>
          <sentencesblock v-on:modal="modal"></sentencesblock>
          <personalblock></personalblock> -->

        <account/>

        <el-col :md="18" :xs="24" :sm="16">
          <el-row :gutter="20" :id="['widgetblock']">
            <wordwidget/>
            <sentencewidget/>
            <textwidget/>
            <personalwidget/>
            <puzzlewidget/>
          </el-row>
        </el-col>
      </el-row>
      <el-dialog title="Это закрытая часть сайта" :visible.sync="dialogVisible">
        <span>
          <a href="" target="_blank">Оплатите подписку</a> чтобы получить полный доступ
        </span>
        <span slot="footer" class="dialog-footer">
           <el-button @click="dialogVisible = false">Закрыть</el-button>
        </span>
      </el-dialog>

      <el-dialog title="Привет!" :visible.sync="greetingVisible">
                    <span>
                        Добро пожаловать, {{username}}!
                    </span>
        <span slot="footer" class="dialog-footer">
                        <el-button @click="greetingVisible = false">Закрыть</el-button>
                    </span>
      </el-dialog>
    </el-main>
  </el-container>
</template>

<script lang="ts">

import Vue from 'vue';
import Component from 'vue-class-component';
import Account from '@/components/home/AccountBlock.vue';
import Wordwidget from '@/components/home/WordWidget.vue';
import Sentencewidget from '@/components/home/SentenceWidget.vue';
import Textwidget from '@/components/home/TextWidget.vue';
import Personalwidget from '@/components/home/PersonalWidget.vue';
import Puzzlewidget from '@/components/home/PuzzleWidget.vue';

  @Component({
    name: 'Home',
    components: {
      Account, Wordwidget, Sentencewidget, Textwidget, Personalwidget, Puzzlewidget,
    },
    mounted() {
      if (!localStorage.getItem('myFirstAdventure')) {
        //   this.greetingVisible = true;
        //   localStorage.setItem('myFirstAdventure', true)
      }
    },
  })
export default class extends Vue {
    name: string = 'Hello!'

    metaInfo: any = { title: 'Icelandic | Scandinaver' }

    dialogVisible: boolean = false

    greetingVisible: boolean = false

    modal() {
      this.dialogVisible = true;
    }

    get username() {
      return this.$store.getters.login;
    }
}
</script>
