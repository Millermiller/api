<template>
    <div class="columns">
        <div class="column is-6">
            <p class="control content">
                <textarea v-model="item.text" placeholder="оригинал" class="textarea"></textarea>
            </p>
        </div>
        <div class="column is-5">
            <p class="control content">
                <textarea v-model="item.value" placeholder="оригинал" class="textarea"></textarea>
            </p>
        </div>
        <div class="column is-1">
            <a :class="['button', 'is-danger', 'is-small']" @click="$emit('remove', index)">
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
  name: 'Modal_example',
})
export default class extends Vue {
      @Prop({ required: true })
      private item!: any
      @Prop({ required: true })
      private index!: any
}
</script>
