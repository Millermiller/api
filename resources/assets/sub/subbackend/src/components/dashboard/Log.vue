<template>
  <li :class="['columns', 'log', item.type, {'today': item.hours < 10}]">
    <p :class="['column', 'is-3', 'is-small']">{{item.created_at}}</p>
    <p :class="['column']">{{item.message}}</p>
    <a class="delete" @click="$emit('deleteLog', item.id)"></a>
  </li>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator'

@Component({
  name: 'Log',
})
export default class extends Vue {
    @Prop({ required: true })
    private item!: any
}
</script>
