<template>
  <transition name="splash">
    <el-row class="errorcard">
      <el-col :span="20">
        <el-row type="flex" align="middle">
          <h4 class="no-margin">{{item.word.word}}</h4>
        </el-row>
        <el-row type="flex" align="bottom" class="error-translate">
          <p>{{item.translate.value}}</p>
        </el-row>
      </el-col>
      <el-col :span="4">
        <i :class="['ion', 'ion-ios-close-empty', 'pointer']" @click="remove(index)"/>
        <i :class="['ion pointer', item.favourite ? activeClass : defaultClass]"
           @click="favourite"/>
      </el-col>
    </el-row>
  </transition>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator'
import cardAPI from '@/api/cardAPI'

  @Component({
    name: 'ErrorItem',
  })
export default class extends Vue {
    @Prop({ required: true })
    public item: any

    @Prop({ required: true })
    public index!: any

    activeClass: string = 'ion-ios-star'

    defaultClass: string = 'ion-ios-star-outline'

    remove(id: number) {
      this.$eventHub.$emit('removeErrorItem', id)
    }

    favourite() {
      const self = this
      if (!this.item.favourite) {
        cardAPI.addFavourite(this.item).then((response) => {
          if (response.status === 201) {
            self.item.favourite = true
            self.$notify.success({
              title: self.item.word.word,
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
              title: self.item.word.word,
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
