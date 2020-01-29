<template>
  <el-col :span="8" :xs="24" id="cardsblock" v-loading.body="loading">
    <el-card class="box-card">
      <div slot="header" class="clearfix">
        <span class="h3" style="line-height: 38px">Карточки в словаре</span>
        <el-tag v-if="name" type="info">{{name}}</el-tag>
      </div>
      <section data-scrollbar style="height: 65vh" v-loading.body="loadingbody">
        <transition-group name="cards" tag="div">
          <card
            v-for="(card, index) in cards"
            :card="card"
            :index="index"
            :key="card.id">
          </card>
        </transition-group>
      </section>
    </el-card>
  </el-col>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator'
import Card from '@/components/cardspage/Card.vue'
import cardAPI from '@/api/cardAPI'
import { ICard } from '@/models/Card'

  @Component({
    name: 'Cards',
    components: {
      card: Card,
    },
  })
export default class extends Vue {
    @Prop({ required: true })
    private name!: string

    @Prop({ required: true })
    private cards!: any

    @Prop({ required: true })
    private loading!: boolean

    loadingbody: boolean = false

    removeCard(data: any) {
      this.loadingbody = true
      cardAPI.destroyCard(data.card).then(
        (response: any) => {
          if (response.status === 204) {
            this.$notify.success({
              title: 'Карточка удалена',
              message: data.card.word!.word,
              duration: 4000,
            })
            this.cards.splice(data.index, 1) // TODO: сделать перезагрузку
            this.$store.commit('removeCard', data.card)
            this.loadingbody = false
          }
        },
        (response: any) => {
          console.log(response.data)
        },
      )
    }

    beforeDestroy() {
      this.$eventHub.$off('deleteCardFromAsset')
    }

    created() {
      this.$eventHub.$on('deleteCardFromAsset', this.removeCard)
    }
}
</script>
