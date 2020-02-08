<template>
    <li class="columns">
        <p :class="['column', 'is-3', 'is-small']">{{item.name}}</p>

        <span v-if="item.readed" class="tag is-success  is-3" @click="openModalBasic">прочитано</span>
        <span v-if="!item.readed" class="tag is-success  is-3" @click="openModalBasic">не прочитано</span>

        <p :class="['column']">{{item.subject}}</p>
        <p :class="['column']">{{item.created_at}}</p>
        <a class="delete" @click="$emit('deleteMessage', item.id)"></a>
        <modal :visible="showModal" :item="item" @close="closeModalBasic"></modal>
    </li>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator'
import Modal from '@/components/dashboard/modals/Modal.vue'

@Component({
  name: 'Message',
  components: {
    Modal,
  },
})
export default class extends Vue {
  @Prop({ required: true })
  private item!: any

  private showModal: boolean = false
  private cardModal: any = null
  private imageModal: any = null

  openModalBasic() {
    console.log('show')
    this.showModal = true
  }
  closeModalBasic() {
    console.log('close')
    this.showModal = false
  }
}
</script>
