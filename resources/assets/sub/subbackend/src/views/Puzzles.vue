<template>
  <div>
    <div class="tile is-ancestor">
      <div class="tile is-parent">
        <article class="tile is-child box">
          <h4 class="title text-center">Паззлы</h4>
          <b-field>
            <p class="control">
              <button class="button is-success" @click="showSettingsModal">Добавить</button>
            </p>
          </b-field>

          <b-table
            :data="puzzles"
            paginated
            narrowed=""
            :loading="loading"
            per-page="10"
          >

            <template slot-scope="props">
              <b-table-column field="id" label="ID" width="40" sortable numeric>
                {{ props.row.id }}
              </b-table-column>

              <b-table-column field="text" label="Text" sortable>
                {{ props.row.text }}
              </b-table-column>

              <b-table-column field="translate" label="translate" sortable>
                {{ props.row.translate }}
              </b-table-column>

              <b-table-column custom-key="actions">
                <button class="button  is-warning" @click="edit(props.row)">
                  <b-icon icon="account-edit" size="is-small"></b-icon>
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

    <b-modal :active.sync="isComponentModalActive" has-modal-card>
      <form action="">
        <div class="modal-card" style="width: 400px">

          <section class="modal-card-body">
            <b-field label="На русском">
              <b-input type="textarea" v-model="edited.text"></b-input>
            </b-field>
          </section>

          <section class="modal-card-body">
            <b-field label="На нерусском">
              <b-input type="textarea" v-model="edited.translate"></b-input>
            </b-field>
          </section>

          <footer class="modal-card-foot">
            <button class="button" type="button" @click="isComponentModalActive = false">Закрыть
            </button>
            <button class="button is-primary" @click="add">Сохранить</button>
          </footer>
        </div>
      </form>
    </b-modal>

  </div>
</template>

<script lang="ts">
import Component from 'vue-class-component'
import Vue from 'vue'
import puzzleAPI from "@/api/puzzleAPI"

  @Component({
    name: 'PuzzlesView',
  })
export default class extends Vue {
    private edited: {} = {
      text: '',
      translate: '',
    }
    private puzzles: [] = []
    private isComponentModalActive: boolean = false

    mounted() {
      this.load()
    }

    load() {
      puzzleAPI.all().then((response) => {
        this.puzzles = response.data
      }, (response) => {
        console.log(response)
      })
    }

    add() {
      puzzleAPI.create(this.edited).then((response) => {
        if (response.data.success) {
          this.load()
          this.$snackbar.open('Загружено!')
          this.closeSettingsModal()
        } else {
          this.$snackbar.open('Ошибка!')
        }
      }, (response) => {
        console.log(response)
      })
    }

    remove(row: any) {
      if (confirm('удалить?')) {
        puzzleAPI.destroy(row.id).then((response) => {
          this.load()
        }, (response) => {
          console.log(response)
        })
      }
    }

    showSettingsModal() {
      this.isComponentModalActive = true
    }

    closeSettingsModal() {
      this.isComponentModalActive = false
    }
}
</script>
