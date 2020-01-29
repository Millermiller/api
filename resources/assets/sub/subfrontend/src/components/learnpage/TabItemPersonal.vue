<template>
  <el-row :class="['list-item', 'pointer', 'open', {'selected': item.selected}]">

    <el-col :span="24">
      <p class="asset-title" style="height: 57px">{{item.title}}</p>
    </el-col>

    <el-row>
      <el-col :span="9" :md="8">
                <span :class="['text-muted', 'small']">
                     <i :class="['ion', 'ion-speedometer', 'ion-small']"></i>
                </span>
        <span
          :class="[
                    'small',
                    {
                      success: item.result > 80,
                      warning: (item.result > 50 && item.result < 80),
                      danger: item.result < 50
                    }
                ]">
                    {{item.result}}%
                </span>
        <span :class="['text-muted', 'small']" style="padding-left: 15px">
                     <i :class="['ion', 'ion-ios-browsers-outline', 'ion-small']"></i>
                    {{item.count}}
                </span>
      </el-col>
      <el-col :span="15" :md="16" class="text-right">
        <template>
                    <span :class="[isActive ? 'text-primary' : 'text-muted', 'pointer', 'small']"
                          @click="cardspage()">
                        <i :class="['ion', 'ion-edit', 'ion-small']"/>
                        изменить
                    </span>
          <span :class="['text-primary', 'small']">|</span>
          <span :class="['text-primary', 'pointer', 'small', {'muted': item.count < 1}]"
                @click="loadTest()">
                        <i :class="['ion', 'ion-ios-redo', 'ion-small']"/>
                        учить
                    </span>
          <span :class="['text-primary', 'small']">|</span>
          <span :class="['text-primary', 'pointer', 'small', {'muted': item.count < 1}]"
                @click="test()">
                         <i :class="['ion', 'ion-ios-checkmark-outline', 'ion-small']"/>
                        тест
                    </span>
        </template>
      </el-col>
    </el-row>
  </el-row>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator'
import IWord from '@/models/Word'
import ISentence from '@/models/Sentence'
import { IPersonal } from '@/models/Personal'

  @Component({
    name: 'TabItemPersonal',
  })
export default class extends Vue {
    @Prop({ required: true })
    private item!: any

    @Prop({ required: true })
    private type!: any

    @Prop({ required: true })
    private index!: number

    words: IWord[] = []

    sentences: ISentence[] = []

    personal: IPersonal[] = []

    get isActive() {
      return this.$store.getters.isActive || this.item.type === 3
    }

    loadTest(): void {
      if (this.item.count > 1) {
        if (window.innerWidth <= 910) {
          this.$eventHub.$emit('closeMenu')
        }
        this.$store.commit('setSelection', { asset: this.item, index: this.index })
        this.$router.push(`/learn/${this.item.id}`)
      }
    }

    cardspage() {
      if (this.isActive) {
        this.$store.dispatch('loadAsset', this.item.id)
        this.$store.commit('setActiveAssetEdit', true)
        this.$router.push('/cards')
      }
    }

    test(): void {
      if (this.item.count > 1) {
        if (window.innerWidth <= 910) {
          this.$eventHub.$emit('closeMenu')
        }
        //  this.$store.commit('setSelection', {asset: this.item, index: this.index})
        this.$router.push(`/test/${this.item.id}`)
      }
    }
}
</script>
