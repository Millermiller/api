<template>
  <div>
    <div class="tile is-ancestor">
      <words/>
      <assets/>
      <audio/>
      <texts/>
    </div>

    <div class="tile is-ancestor">
      <div class="tile is-parent is-8">
        <article class="tile is-child box">
          <div v-if="loading" id="nprogress">
            <div class="spinner-icon"></div>
          </div>
          <h4 class="title">Log</h4>
          <div class="content">
            <ul>
              <log v-for="item in log" :item="item" v-on:deleteLog="deleteLog"></log>
            </ul>
          </div>
        </article>
      </div>
      <div class="tile is-parent is-4">
        <article class="tile is-child box">
          <div v-if="loading" id="nprogress">
            <div class="spinner-icon"></div>
          </div>
          <h4 class="title">Messages</h4>
          <div class="content">
            <ul>
              <message v-for="item in messages" :item="item"
                       v-on:deleteMessage="deleteMessage"></message>
            </ul>
          </div>
        </article>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Component from 'vue-class-component'
import Vue from 'vue'
import Message from '@/components/dashboard/Message.vue'
import Log from '@/components/dashboard/Log.vue'
import Words from '@/components/dashboard/widgets/Words.vue'
import Assets from '@/components/dashboard/widgets/Assets.vue'
import Audio from '@/components/dashboard/widgets/Audio.vue'
import Texts from '@/components/dashboard/widgets/Texts.vue'
import messageAPI from "@/api/messageAPI"
import logAPI from "@/api/logAPI"

  @Component({
    name: 'DashboardView',
    components: {
      Message,
      Log,
      Words,
      Assets,
      Audio,
      Texts,
    },
  })
export default class extends Vue {
    private words: string = ''
    private assets: string = ''
    private audiofiles: string = ''
    private texts: string = ''
    private log: {} = {}
    private messages: {} = {}
    private loading: boolean = false


    deleteLog(id: number) {
      logAPI.delete(id).then((response) => {
        if (response.data.success) {
          this.log = response.data.log
          this.$snackbar.open('Удалено!')
        } else {
          this.$snackbar.open('Ошибка!')
        }
      }, (response) => {
        console.log(response)
      })
    }

    deleteMessage(id: number) {
      messageAPI.delete(id).then((response) => {
        if (response.data.success) {
          this.messages = response.data.messages
          this.$snackbar.open('Удалено!')
        } else {
          this.$snackbar.open('Ошибка!')
        }
      }, (response) => {
        console.log(response)
      })
    }
}
</script>
