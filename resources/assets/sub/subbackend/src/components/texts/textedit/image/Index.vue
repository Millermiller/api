<template>
    <div>
        <div>
            <i v-show="! item.image" class="icon fa fa-picture-o"></i>
            <img style="width: 400px;margin: 20px;" v-show="item.image" :src="item.image">
        </div>

        <div>
            <label>
                <input @change="previewThumbnail" name="thumbnail" type="file" style="display: none">
                <span class="file-cta">
                        <span class="file-icon">
                            <i class="fa fa-upload"></i>
                        </span>
                        <span class="file-label">
                            Выберите файл
                        </span>
                    </span>
            </label>
            <button @click="upload" class="button">upload</button>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator'
import textAPI from "@/api/textAPI"

@Component({
  name: 'Index',
})
export default class extends Vue {
  @Prop({ required: true })
  private item!: any

  private imageSrc: string = ''
  private fileUploadFormData: FormData = new FormData()

  previewThumbnail(event: any) {
    const input = event.target;

    if (input.files && input.files[0]) {
      const reader = new FileReader();
      this.fileUploadFormData.append('file', input.files[0]);
      const vm = this;

      reader.onload = function (e: any) {
        vm.item.image = e.target.result;
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  upload() {
    textAPI.saveImage(this.item.id, this.fileUploadFormData).then((response) => {
      if (response.data.success) {
        this.$snackbar.open('Обновлено!')
      } else {
        this.$snackbar.open('Ошибка!')
      }
    }, (response) => {
      this.$snackbar.open('Ошибка!')
    })
  }
}
</script>
