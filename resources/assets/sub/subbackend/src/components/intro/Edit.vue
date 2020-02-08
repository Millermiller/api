<template>
    <div class="tile is-ancestor">
        <div class="tile is-parent">
            <div class="tile is-child box">

                <div class="header">Intro №{{form.id}}</div>

                <froala :tag="'textarea'" :config="config" v-model="form.content"></froala>

                <b-field label="Страница">
                    <b-select placeholder="Выберите страницу" v-model="form.page">
                        <option
                                v-for="page in pages"
                                :value="page"
                                :key="page">
                            {{ page }}
                        </option>
                    </b-select>
                </b-field>


                <b-field label="element">
                    <b-input v-model="form.element"></b-input>
                </b-field>

                <b-field label="position">
                    <b-select placeholder=" - " v-model="form.position">
                        <option
                                v-for="position in positions"
                                :value="position"
                                :key="position">
                            {{ position }}
                        </option>
                    </b-select>
                </b-field>

                <b-field label="sort">
                    <b-input v-model="form.sort"></b-input>
                </b-field>

                <b-field label="tooltipClass">
                    <b-input v-model="form.tooltipClass"></b-input>
                </b-field>

                <div class="active">
                    <b-checkbox v-model="form.active"
                                true-value="1"
                                false-value="0"> active</b-checkbox>
                </div>

                <p class="control">
                    <button class="button  is-success" @click="save()">Сохранить</button>
                    <button class="button  is-light" @click="back()">Назад</button>
                </p>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import introAPI from "@/api/introAPI"

@Component({
  name: 'Edit',
})
export default class extends Vue {
  private form: any = {
    id: 0,
    page: '',
    element: '',
    position: '',
    sort: '',
    tooltipClass: '',
    active: 0,
    content: '',
  }
  private pages: any = [
    'login',
    'main',
    'learnHome',
    'learn',
    'testHome',
    'test',
    'cards',
    'texts',
    'text',
  ]
  private positions: any = [
    'top',
    'right',
    'bottom',
    'left',
  ]
  config: any = {
    imageUploadURL: '/admin/articles/upload',
    events: {
      'froalaEditor.initialized': function () {
        console.log('initialized')
      },
    },
  }

  load(id: number) {
    introAPI.load(id).then((response) => {
      this.form = response.data
    }, (response) => {
      console.log(response)
    })
  }

  save() {
    introAPI.save(this.form.id, this.form).then((response) => {
      if (response.status === 200) this.$router.go(-1)
      else this.$snackbar.open('Ошибка!')
    }, (response) => {
      console.log(response)
    })
  }

  back() {
    this.$router.go(-1)
  }

  mounted() {
    this.load(parseInt(this.$route.params.id, 10))
  }
}
</script>
