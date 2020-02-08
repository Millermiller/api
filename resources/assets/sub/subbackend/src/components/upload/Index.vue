<template>
  <div>
    <div class="tile is-ancestor">
      <div class="tile is-parent">
        <article class="tile is-child box">
          <form enctype="multipart/form-data" action="" method="post">
            <input type="file" name="file" @change="bindFile"/>
            <a class="button is-success" @click="upload">Загрузить</a>
          </form>
        </article>
      </div>
      <div class="tile is-parent">
        <article class="tile is-child box">
          <div class="block">
            <div class="control is-horizontal">
              <div class="control-label">
                <label class="label">Добавить</label>

              </div>
              <div class="control is-grouped">
                <p class="control is-expanded">
                  <input class="input" type="text" v-model="orig" placeholder="icelandic">
                </p>
                <p class="control is-expanded">
                  <input class="input" type="email" v-model="translate" placeholder="перевод">
                </p>
                <button class="button is-success" @click="add">Добавить</button>
              </div>
            </div>

            <div class="field">
              <b-switch v-model="issentence"
                        true-value="1"
                        false-value="0">
                {{ switchStat }}
              </b-switch>
            </div>
          </div>
        </article>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import fileAPI from "@/api/fileAPI"
import assetAPI from "@/api/assetAPI"

@Component({})
export default class extends Vue {
    fileUploadFormData: FormData = new FormData()
    orig: string = ''
    translate: string = ''
    issentence: boolean = false


    bindFile(e: any) {
      e.preventDefault()
      this.fileUploadFormData.append('file', e.target.files[0])
    }

    upload() {
      fileAPI.uploadWordfile(this.fileUploadFormData).then((response) => {
        if (response.data.success) {

        }
      }, (response) => {
        console.log(response)
      })
    }

    add() {
      assetAPI.addAdminCard({ word: this.orig, translate: this.translate, issentence: this.issentence }).then((response) => {
        if (response.data.success) {
          this.orig = this.translate = ''
        }
      }, (response) => {
        console.log(response)
      })
    }

    get switchStat() {
      return this.issentence ? 'Предложение' : 'Слово'
    }
}
</script>
