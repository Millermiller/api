<template>
    <div class="column  is-6">
        <div class="block">
            <div class="control is-horizontal">
                <div class="control is-grouped">
                    <p class="control is-expanded has-addons">
                        <span>{{index + 1}})&nbsp; </span>
                        <input class="input" type="text" v-model="word.word" placeholder="Оригинал">
                        <input class="input" type="text" v-model="word.orig" placeholder="Перевод">
                        <a :class="['button']" @click="$emit('add', {index:index, word:word})">
                            <span class="icon">
                                  <i class="fa fa-plus"></i>
                            </span>
                        </a>
                        <a :class="['button', 'is-danger']" @click="$emit('remove', {index:index, word:word})">
                            <span class="icon">
                                  <i class="fa fa-trash-o"></i>
                            </span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator'

@Component({
  name: 'Item',
})
export default class extends Vue {
  @Prop({ required: true })
  private word!: any
  @Prop({ required: true })
  private index!: any

  private translate: string = ''
}
</script>
