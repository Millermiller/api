<template>
  <b-modal :active.sync="visible" @close="close">
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
          <p class="control content">
                        <textarea class="textarea" placeholder="оригинал" v-model="form.origtext"
                                  style="height: 500px;"></textarea>
          </p>
        </div>
        <div class="column is-6">
          <p class="control content">
                        <textarea class="textarea" placeholder="перевод" v-model="form.translate"
                                  style="height: 500px;"></textarea>
          </p>
        </div>
      </div>
      <div class="columns">
        <div class="column">
          <button class="button is-succes" @click="$emit('save', form)">Сохранить</button>
        </div>
      </div>
    </div>
  </b-modal>
</template>

<script lang="ts">
  import Vue from 'vue'
  import Component from 'vue-class-component'
  import { Prop } from "vue-property-decorator"

  @Component({})
  export default class extends Vue {
    @Prop({required: true})
    private visible!: any

    private form: any = {
      title: '',
      origtext: '',
      translate: ''
    }

    close() {
      this.$emit('close')
    }

  }
</script>

<style>
  .modal-card, .modal-content {
    width: 1100px;
  }
</style>
