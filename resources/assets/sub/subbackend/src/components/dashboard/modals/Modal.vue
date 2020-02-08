<template>
    <div class="box">
        <article class="media">
            <div class="media-left">
                <figure class="image is-64x64">
                    <img src="http://placehold.it/128x128" alt="Image">
                </figure>
            </div>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong>{{item.name}}</strong>
                        <small>№{{item.user}}</small>
                        <span>{{item.subject}}</span>
                        <br>
                        {{item.message}}
                    </p>
                </div>
            </div>
        </article>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop, Watch } from 'vue-property-decorator'
import messageAPI from "@/api/messageAPI"

@Component({
  name: 'Modal',
})
export default class extends Vue {
  @Prop({ required: true })
  private item!: any
  @Prop({ required: true })
  private visible!: any

  close() {
    this.$emit('close')
  }
  @Watch('visible')
  private onChange(val: any) {
    if (val) {
      messageAPI.read(this.item.id).then((response) => {
        if (response.data.success) {
          this.item.readed = true
        } else {
          this.$snackbar.open('Ошибка!')
        }
      }, (response) => {
        console.log(response)
      })
    }
  }
}
</script>
