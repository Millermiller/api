<template>
  <div>
    <div class="tile is-ancestor">
      <div class="tile is-parent">
        <article class="tile is-child box">
          <h4 class="title text-center">Тексты</h4>
          <button class="button is-small" style="margin: 10px 0;" @click="showSettingsModal">
            Добавить
          </button>

          <b-table
            :data="texts"
            paginated
            narrowed=""
            :loading="loading"
            per-page="10"
          >

            <template slot-scope="props">
              <b-table-column field="id" label="ID" width="40" sortable numeric>
                {{ props.row.id }}
              </b-table-column>

              <b-table-column field="level" label="level" sortable>
                {{ props.row.level }}
              </b-table-column>

              <b-table-column field="title" label="title" sortable>
                {{ props.row.title }}
              </b-table-column>

              <b-table-column field="description" label="description" sortable>
                {{ props.row.description }}
              </b-table-column>

              <b-table-column field="image" label="" width="90">
                <img :class="['avatar-small']" :src="props.row.image">
              </b-table-column>

              <b-table-column custom-key="actions">
                <button class="button  is-warning" @click="edit(props.row)">
                  <b-icon icon="account-edit" size="is-small"></b-icon>
                </button>
                <button class="button  is-warning" @click="setVisibility(props.row)">
                  <b-icon :icon="icon(props.row)" size="is-small"></b-icon>
                </button>
                <button class="button  is-danger" @click="remove(props.row)">
                  <b-icon icon="account-remove" size="is-small"></b-icon>
                </button>
              </b-table-column>
            </template>
          </b-table>
        </article>
      </div>
    </div>
    <b-modal :active.sync="isComponentModalActive" @close="close">
      <div class="box" style="width: 1100px">
        <div class="columns">
          <div class="column">
            <p class="control">
              <input class="input" type="text" v-model="form.title" placeholder="Название">
            </p>
          </div>
        </div>
        <div class="columns">
          <div class="column is-6">
            <b-field label="оригинал">
              <b-input type="textarea" v-model="form.origtext" style="height: 500px;"></b-input>
            </b-field>
          </div>
          <div class="column is-6">
            <b-field label="перевод">
              <b-input type="textarea" v-model="form.translate" style="height: 500px;"></b-input>
            </b-field>
          </div>
        </div>
        <div class="columns">
          <div class="column">
            <button class="button is-succes" @click="add">Сохранить</button>
          </div>
        </div>
      </div>
    </b-modal>
  </div>

</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'

import Modal from '@/components/texts/Modal.vue'
import textAPI from "@/api/textAPI"

  @Component({
    name: 'Index',
    components: {
      Modal,
    },
  })
export default class extends Vue {
    private form: any = {
      title: '',
      origtext: '',
      translate: '',
    }
    private texts: [] = []
    private isComponentModalActive: boolean = false


    icon(row: any) {
      return (row.published) ? 'eye' : 'eye-off'
    }

    load() {
      textAPI.getTexts().then((response) => {
        this.texts = response.data
      }, (response) => {
        console.log(response)
      })
    }

    remove(row: any) {
      if (confirm('удалить?')) {
        textAPI.deleteText(row.id).then((response) => {
          this.load()
        }, (response) => {
          console.log(response)
        })
      }
    }

    edit(row: any) {
      this.$router.push({ name: 'textedit', params: { id: row.id } })
    }

    add(form: any) {
      textAPI.saveText(this.form).then((response) => {
        if (response.data.success) {
          this.$snackbar.open('Загружено')
          this.load()
          this.closeSettingsModal()
        } else {
          this.$snackbar.open('Ошибка')
        }
      }, (response) => {
        console.log(response)
      })
    }

    setVisibility(item: any) {
      textAPI.publishText({
        id: item.id,
        published: (item.published) ? '0' : '1',
      }).then((response) => {
        if (response.data.success) {
          this.load()
        } else {
          this.$snackbar.open('Ошибка')
        }
      }, (response) => {
        console.log(response)
      })
    }

    showSettingsModal() {
      this.isComponentModalActive = true
    }

    closeSettingsModal() {
      this.isComponentModalActive = false
    }

    mounted() {
      this.load()
    }
}
</script>
