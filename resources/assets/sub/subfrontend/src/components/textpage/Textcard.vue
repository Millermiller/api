<template>
  <el-col :lg="6" :sm="12" :xs="24" id="textblock">
    <el-card :class="['text', {'open': text.active, 'not-available': !text.available}]"
             :body-style="{ padding: '0px' }">

      <div class="image" v-bind:style="{ 'background-image': 'url(' + text.image + ')' }"></div>

      <el-container>
        <el-main>
          <el-row>
            <el-col :span="24">
              <p class="text-title">{{text.title}}</p>
            </el-col>
          </el-row>
          <el-row type="flex" justify="end">
            <el-button :type="buttontype" plain @click="gototext()" :disabled="!text.available">
              {{ buttontext }}
            </el-button>
          </el-row>
        </el-main>
      </el-container>
    </el-card>
  </el-col>
</template>

<script lang="ts">
import Vue from 'vue'
import Component from 'vue-class-component'
import { Prop } from 'vue-property-decorator'

  @Component({
    name: 'TextCard',
  })
export default class extends Vue {
    @Prop({ required: true })
    private text!: any

    get buttontype() {
      return (!this.text.available) ? 'info' : (this.text.active) ? 'primary' : 'warning'
    }

    get buttontext() {
      return (!this.text.available) ? 'Недоступно базовым аккаунтам' : (this.text.active) ? 'Перейти' : 'Закрыто'
    }

    gototext() {
      if (this.text.active && this.text.available) this.$router.push(`/translates/${this.text.id}`)
    }
}
</script>
