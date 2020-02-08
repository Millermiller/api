<template>
    <div class="columns" v-on:mouseover="$emit('show', item)" v-on:mouseout="$emit('clear')">
        <div class="column is-5">
            <p class="control">
                <input class="input" type="text" placeholder="orig" v-model="item.orig">
            </p>
        </div>
        <div class="column is-5">
            <p class="control">
                <input class="input" type="text" placeholder="extra" v-model="item.extra">
            </p>
        </div>
        <div class="column is-2">
            <a :class="['button', 'is-danger']" @click="$emit('remove', index)">
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

@Component({
  name: 'Extra',
})
export default class extends Vue {
  @Prop({ required: true })
  private item!: any
  @Prop({ required: true })
  private index!: any
}
</script>
