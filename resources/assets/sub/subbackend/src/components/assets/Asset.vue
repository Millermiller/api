<template>
  <li class="columns">
    <p :class="['column', 'is-7', 'pointer', {'info': item.id === activeAssetId}]"
       @click="load(item.id)">
      {{item.level}}. {{item.title}} <span class="text-success">({{item.cards_count}})</span>
    </p>

    <p :class="['column control-block', 'is-5']">
      <a :class="['button', 'is-small']" @click="$emit('edit', item)">
                <span class="icon">
                      <i class="fa fa-pencil"></i>
                </span>
      </a>

      <a :class="['button', 'is-small']" @click="load(item.id)">
                <span class="icon">
                      <i class="fa fa-eye"></i>
                </span>
      </a>

      <a :class="['button', 'is-small', {'is-loading': loaded }]" @click="forvo(item.id)">Forvo</a>

      <a :class="['button', 'is-danger', 'is-small']" @click="$emit('remove', item)">
                <span class="icon">
                      <i class="fa fa-trash-o"></i>
                </span>
      </a>
    </p>
  </li>
</template>

<style>
  p.column.control-block {
    padding: .75rem 0;
  }
</style>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator'
import assetAPI from '@/api/assetAPI'
import forvoAPI from '@/api/forvoAPI'

  @Component({
    name: 'Asset',
    components: {
    },
  })
export default class extends Vue {
    @Prop({ required: true })
    private item!: any

    private loaded: boolean = false

    load(id: number) {
      this.loaded = true
      assetAPI.getAsset(id).then((response) => {
        if (response.data.success) {
          this.loaded = false
          this.$store.commit('setActiveAsset', response.data.data)
        } else {
          this.$snackbar.open('Ошибка!')
        }
      },
      (response) => {
        console.log(response)
      })
    }

    forvo(id: number): any {
      // eslint-disable-next-line no-alert
      if (confirm('Загрузить аудио?')) {
        this.loaded = true
        forvoAPI.getAudio(id).then((response) => {
          if (response.data.success) {
            this.loaded = false
            this.$snackbar.open(`Завершено!${response.data.count} из ${response.data.all}`)
          } else {
            this.$snackbar.open('Ошибка!')
          }
        }, (response) => {
          console.log(response)
        })
      }
    }

    get activeAssetId() {
      return this.$store.getters.activeAssetId
    }
}
</script>
