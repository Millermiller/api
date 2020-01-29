<template>
  <div class="slide">
    <p class="word">{{item.word.word}}</p>

    <template v-if="!item.nocontrols">

      <div :class="['translate-area', 'pointer']" @click="showTranslate">
        <template v-if="show && item.translate">
          <p class="slide-value">{{item.translate.value}}</p>
          <div class="example-area">
            <template v-for="(example, index) in item.examples">
              <p :html="example.text" :key="index" :class="example-text"/>
              <p v-html="example.value" :key="index" class="example-value"/>
            </template>
          </div>
          <el-row v-if="item.word.creator" :class="['danger', 'text-right', 'small', 'creator']">
            <el-popover
              placement="top-start"
              width="250"
              trigger="hover">
              <el-row>
                <el-col :span="6">
                  <div class="avatar-wrapper-small pull-left">
                    <div class="avatar">
                      <img :class="['avatar-small']" :src="item.word.user.avatar" alt="">
                    </div>
                  </div>
                </el-col>
                <el-col :span="18">
                  <p :class="['text-danger']">{{item.word.user.login}}</p>
                  <p>Создано карточек: {{item.word.user.cardsCreated}}</p>
                </el-col>
              </el-row>
              <span slot="reference" :class="['no-margin', 'danger', 'pull-right', 'small']">
                Добавлено: {{item.word.user.login}}
              </span>
            </el-popover>
          </el-row>
        </template>
        <i v-else class="ion-help"/>
      </div>

      <audio :src="item.word.audio" preload="none" ref="player"/>

      <i :class="['ion favourite-button pointer', item.favourite ? activeClass : defaultClass]"
         @click="favourite"/>

      <i :class="['ion-ios-volume-high', 'ion', 'pointer']" @click="play"/>
    </template>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop, Watch } from 'vue-property-decorator'
import cardAPI from '@/api/cardAPI'
import { ICard } from '@/models/Card'

  @Component({
    name: 'Slide',
  })
export default class extends Vue {
    @Prop({ required: true })
    private item!: ICard

    activeClass: string = 'ion-ios-star'

    defaultClass: string = 'ion-ios-star-outline'

    show: boolean = false

    @Watch('$route', { immediate: true, deep: true })
    onUrlChange(newVal: any) {
      this.show = false
    }

    showTranslate() {
      this.show = (!this.show)
    }

    play() {
      // @ts-ignore
      this.$refs.player.play()
    }

    favourite() {
      const self = this
      if (!this.item.favourite) {
        cardAPI.addFavourite(this.item).then((response) => {
          if (response.status === 201) {
            self.item.favourite = true
            self.$notify.success({
              title: self.item.word!.word,
              message: 'Добавлено в Избранное',
              duration: 2000,
            })
            this.$store.commit('addCardToFavorite')
          } else {
            console.log(response.data)
          }
        },
        (error) => {
          console.log(error)
        })
      } else {
        cardAPI.destroyFavourite(this.item).then((response) => {
          if (response.status === 204) {
            self.item.favourite = false
            self.$notify.success({
              title: self.item.word!.word,
              message: 'Удалено из Избранного',
              duration: 2000,
            })
            this.$store.commit('removeCardFromFavorite')
          } else {
            console.log(response.data)
          }
        },
        (error) => {
          console.log(error)
        })
      }
    }
}
</script>
