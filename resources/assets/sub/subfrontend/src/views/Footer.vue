<template>
  <el-row id="footer">
    <el-row :gutter="20" class="footer-inner">
      <el-col :span="12">
        <span class="copyright">scandinaver.org © 2018</span>
      </el-col>
      <el-col :md="{span:4, offset:8}" :xs="{span:12}">
        <el-button type="text" @click="showIntro()">Помощь</el-button>
        <el-button type="text" @click="dialogFormVisible = true">Обратная связь</el-button>
      </el-col>
    </el-row>

    <el-dialog title="Ваше сообщение:" :visible.sync="dialogFormVisible">
      <el-form :model="form" :rules="rules" ref="messageform">
        <el-form-item prop="message">
          <el-input type="textarea" v-model="form.message" placeholder="Сообщение"
                    id="feedback_message"/>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
                    <el-button @click="dialogFormVisible = false">Отмена</el-button>
                    <el-button type="primary" @click="submit">Отправить</el-button>
                </span>
    </el-dialog>
  </el-row>
</template>

<script lang="ts">
import Vue from 'vue';
import Component from 'vue-class-component';
import feedbackAPI from '@/api/feedbackAPI';
import IFeedbackForm, { FeedbackForm } from '@/api/IFeedbackForm';

  @Component
export default class Footer extends Vue {
    dialogFormVisible: boolean = false

    introVisible: boolean = false

    form: IFeedbackForm = new FeedbackForm()

    rules: {} = {
      message: [
        { required: true, message: 'Поле не может быть пустым!', trigger: 'sumbit' },
      ],
    }

    submit() {
      // @ts-ignore
      this.$refs.messageform.validate((valid): void => {
        if (valid) {
          feedbackAPI.create(this.form).then(
            (response) => {
              if (response.status === 201) {
                this.dialogFormVisible = false
                this.$notify.success({
                  title: '',
                  message: 'Сообщение отправлено',
                  duration: 2000,
                });
                this.form = new FeedbackForm()
              }
            },
            (response) => {
              this.dialogFormVisible = false
              console.log(response.data)
            },
          )
        }
      })
    }
  /*
    showIntro() {
      this.$store.commit('setIntroVisibility', {page: this.$route.name, visible: true})
    }

    startIntro(name) {
      this.$store.commit('setIntroVisibility', {page: name, visible: false})
    }

    mounted() {
      let self = this;

      this.$store.watch(function (state) {
          return state.introNeed
        },
        function (val) {
          if (val.main && self.$route.name === 'main') self.startIntro('main')
          if (val.learnHome && self.$route.name === 'learnHome') self.startIntro('learnHome')
          if (val.learn && self.$route.name === 'learn') self.startIntro('learn')
          if (val.testHome && self.$route.name === 'testHome') self.startIntro('testHome')
          if (val.test && self.$route.name === 'test') self.startIntro('test')
          if (val.cards && self.$route.name === 'cards') self.startIntro('cards')
          if (val.texts && self.$route.name === 'texts') self.startIntro('texts')
          if (val.text && self.$route.name === 'text') self.startIntro('text')
        },
        {deep: true}
      )
    }
    */
}
</script>
