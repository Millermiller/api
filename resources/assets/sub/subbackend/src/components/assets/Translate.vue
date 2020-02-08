<template>
    <div class="columns">
        <div class="column">
            <span class="asset_title">{{item.word.word}}</span>
        </div>
        <div class="column">
            <span class="asset_title">{{item.value}}</span>
        </div>
        <div class="column">
            <a :class="['button', 'is-success', 'is-small']" @click="add">
                <span class="icon">
                      <i class="fa fa-plus" style="color: #fff"></i>
                </span>
            </a>
            <a :class="['button', 'is-danger', 'is-small']"   @click="$emit('remove', {item: item, index: index})">
                <span class="icon">
                      <i class="fa fa-trash-o"></i>
                </span>
            </a>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator'
import assetAPI from "@/api/assetAPI"

  @Component({
    name: 'Translate',
  })
export default class extends Vue {
    @Prop({ required: true })
    private item!: any
    @Prop({ required: true })
    private index!: any

    add() {
      const data = {
        word_id: this.item.word.id,
        translate_id: this.item.id,
        asset_id: this.$store.getters.activeAssetId,
        index: this.index,
      }
      assetAPI.addCard(data).then(
        (response) => {
          if (response.data.success) {
            this.$store.commit('addCard', response.data.card)
            this.$emit('increment', this.index)
          }
        },
        (response) => {

        },
      )
    }
}
</script>
