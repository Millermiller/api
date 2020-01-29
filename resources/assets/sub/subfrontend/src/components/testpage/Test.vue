<template>
  <el-col :span="8" :xs="24" id="testblock">
    <el-card class="box-card" v-loading.body="loading">
      <div slot="header" class="clearfix">
        <vue-progress-bar/>
        <h3 style="height: 76px" class="text-center">
          {{question.word ? question.word.word : 'Выберите словарь'}}
        </h3>
      </div>
      <div class="variants">
        <p class="pointer" v-for="(variant, index) in variants.data" @click="check(variant)" :key="index">{{variant.text}}</p>
      </div>
    </el-card>

    <el-dialog title="Результаты:" :visible.sync="dialogVisible">
      <el-row type="flex" align="middle">
        <el-col :md="18">
          <p v-if="percent >= 80" class="success">Вы перешли на следующий
            уровень!</p>
          <p v-if="percent < 80" class="text-danger">Вы не прошли тест!</p>
          <p>Правильные ответы: {{success}} из {{quantity}}</p>
        </el-col>
        <el-col :md="6">
          <span :class="['percentage',  percent < 80 ? 'warning' : 'success']">{{percent}}%</span>
        </el-col>
      </el-row>
      <template v-if="fail > 0">
        <el-row>
          <p>Ошибки:</p>
          <p v-for="(error, index) in errors" :key="index">{{error.word.word}} - {{error.translate.value}}</p>
        </el-row>
      </template>
      <span slot="footer" class="dialog-footer">
                <el-button v-if="percent < 80"
                           @click="reload">Попробовать еще раз</el-button>
                <el-button @click="dialogVisible = false">Закрыть</el-button>
            </span>
    </el-dialog>
  </el-col>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Watch } from 'vue-property-decorator'
import { Route } from 'vue-router'
import assetAPI from '@/api/assetAPI'
import { Card, ICard } from '@/models/Card'
import { TranslatesCollection } from '@/models/TranslatesCollection'
import VariantsCollection from '@/models/VariantsCollection'
import testAPI from '@/api/testAPI'
import { Collection } from '@/models/Collection';

  @Component({
    name: 'Test',
  })
export default class extends Vue {
  metaInfo() {
    return {
      title: this.title ? `Тесты | ${this.title}` : 'Тесты',
    }
  }

    id: number = 0

    // id теста
    title: string = ''

    cards: Collection = new Collection([])

    // all data
    translates: string[] = []

    // массив всех translates
    quantity: number = 0

    // количество вопросов
    question?: ICard = new Card()

    // текущий вопрос
    variants?: VariantsCollection = new VariantsCollection([]) // 4 варианта ответа на текущий вопрос

    answers: number = 0

    // количество данных ответов
    success: number = 0

    // количество правильных ответов
    percent: number = 0

    // процент правильных ответов
    fail: number = 0 // количество неправильных ответов

    errors: any[] = [] // массив ошибок

    dialogVisible: boolean = false

    loading: boolean = false

    @Watch('$route')
    private onRouteChange(route: Route) {
      if (route.params.id) this.getAsset(parseInt(route.params.id, 10))
    }


    created() {
      this.percent = 0
      this.$Progress.set(0)
      this.$store.commit('resetError')
      if (parseInt(this.$route.params.id, 10) > 0) this.getAsset(parseInt(this.$route.params.id, 10))
    }

    reload() {
      this.getAsset(this.id)
      this.dialogVisible = false
    }

    getAsset(id: number) {
      this.loading = true
      this.id = id
      assetAPI.getAsset(id).then((response) => {
        if (response.data.success === false) {
          this.$notify.error({
            title: 'Ошибка',
            message: response.data.message,
            duration: 4000,
          })
        } else {
          this.$store.commit('setSelection', id)
          this.cards = new Collection(response.data.cards)
          this.cards.shuffle()
          this.title = response.data.title
          this.quantity = this.cards.count()
          this.$store.dispatch('setActiveAssetType', response.data.type)
          this.$store.commit('setQuantity', this.quantity)
          this.$store.commit('resetError')
          this.$store.commit('resetPercent')
          this.$store.commit('setTitle', response.data.title)
          this.$store.commit('setResult', response.data.result)
          this.$store.commit('setLevel', response.data.level)
          this.translates = []
          this.success = 0
          this.answers = 0
          this.errors = []
          this.percent = 0

          this.cards.data.forEach((el: ICard) => {
            this.translates.push(el.translate.value)
          })

          this.$Progress.set(0)
          this.createTest()
          this.loading = false
        }
      }, (response) => {
        console.log(response)
      })
    }

    check(variant: any) {
      this.answers++
      this.$Progress.set(Math.floor((this.answers * 100) / this.quantity))
      if (variant.correct) {
        this.$Progress.setColor('#20A0FF')
        this.success++
        this.percent = Math.floor((this.success * 100) / this.quantity)
        this.$store.commit('setPercent', this.percent)
        this.next()
      } else {
        this.$Progress.setColor('#FF4949')
        this.fail++
        this.errors.push(this.question) // todo: use store
        this.$store.commit('setError', this.question)
        this.next()
      }
    }

    next() {
      if (this.cards.count() > 0) this.createTest()
      else {
        this.question = new Card()
        this.variants = new VariantsCollection([])
        this.dialogVisible = true

        if (this.percent > this.$store.getters.result) this.save()

        if (this.percent > 80) this.nextLevel()
      }
    }

    createTest() {
      this.question = this.cards.data.pop()
      this.variants = new VariantsCollection([{
        text: this.question!.translate.value,
        correct: true,
      }])
      const indexes = []
      const translates: TranslatesCollection = new TranslatesCollection(this.translates.slice())
      translates.remove(this.question!.translate.value)

      while (this.variants.count() < ((this.quantity > 4) ? 4 : this.quantity)) {
        const l = Math.floor(Math.random() * translates.count())

        if (indexes.indexOf(l) === -1) {
          indexes.push(l)
          this.variants.add({ text: translates.get(l), correct: false })
        }
      }

      this.variants.shuffle()
    }

    save() {
      testAPI.saveResult(this, this.percent).then(
        (response) => {
          this.$store.dispatch('reloadStore')
        },
        (response) => {
          console.log(response.data)
        },
      )
    }

    nextLevel() {
      testAPI.nextLevel(this).then(
        (response) => {
          this.$store.dispatch('reloadStore')
        },
        (response) => {
          console.log(response.data)
        },
      )
    }
}
</script>
