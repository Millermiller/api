<template>
  <div class="box">
    <p class="control content">
      <textarea class="textarea" placeholder="Textarea" v-model="form.content"></textarea>
    </p>
    <button class="button is-success" @click="save">Сохранить</button>
    <button class="button is-warning" @click="clear">Очистить</button>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop, Watch } from 'vue-property-decorator'
import textAPI from "@/api/textAPI"

@Component({
  name: 'Index',
})
export default class extends Vue {
    @Prop({ required: true })
    private item!: any

    private form: any = {
      content: '',
    }

    @Watch('item')
    private onChange(val: any) {
      this.form.content = val.description
    }

    save() {
      textAPI.saveDescription(this.item.id, this.form).then((response) => {
        if (response.data.success) {
          this.$snackbar.open('Обновлено!')
          this.$emit('reload')
        } else {
          this.$snackbar.open('Ошибка!')
        }
      }, (response) => {
        this.$snackbar.open('Ошибка!')
      })
    }

    clear() {
      this.form.content = ''
    }
}
</script>
