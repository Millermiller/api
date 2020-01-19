<template>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <b-field>
                        <b-input v-model="newcategory"></b-input>
                        <p class="control">
                            <button class="button is-success" @click="add">Добавить</button>
                        </p>
                    </b-field>

                    <b-table
                            :data="categories"
                            paginated
                            narrowed=""
                            :loading="loading"
                            per-page="10"
                    >

                        <template slot-scope="props">
                            <b-table-column field="id" label="ID" width="40" sortable numeric>
                                {{ props.row.id }}
                            </b-table-column>

                            <b-table-column field="name" label="Name" sortable>
                                {{ props.row.name }}
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
                    <b-modal :active.sync="isComponentModalActive" has-modal-card>
                        <form action="">
                            <div class="modal-card" style="width: auto">
                                <header class="modal-card-head">
                                    <p class="modal-card-title">Категория</p>
                                </header>
                                <section class="modal-card-body">
                                    <b-field label="Название">
                                        <b-input type="text" v-model="edited.name"></b-input>
                                    </b-field>
                                </section>
                                <footer class="modal-card-foot">
                                    <button class="button" type="button" @click="isComponentModalActive = false">Закрыть</button>
                                    <button class="button is-primary" @click="update">Сохранить</button>
                                </footer>
                            </div>
                        </form>
                    </b-modal>
                </article>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                edited: {
                    id:'',
                    name:''
                },
                categories: [],
                newcategory: '',
                isComponentModalActive: false,
            }
        },
        mounted(){
            this.load()
        },
        methods: {
            load(){
                this.$http.get('/admin/categories').then((response) => {
                    this.categories = response.body
                }, (response) => {
                    console.log(response)
                })
            },
            edit(row){
                this.edited = row
                this.isComponentModalActive = true
            },
            update(){
                this.$http.put('/admin/categories/' + this.edited.id, this.edited).then((response) => {
                    if(response.status === 200){
                        this.isComponentModalActive = false
                        this.$snackbar.open('Обновлено')
                        this.load()
                    }
                    else
                        this.$snackbar.open('Ошибка!')
                }, (response) => {
                    console.log(response)
                })
            },
            add(){
                this.$http.post('/admin/categories', {name: this.newcategory}).then((response) => {
                    if(response.status === 201){
                        this.load()
                    }
                    else{
                        this.$snackbar.open('Ошибка!')
                        console.log(response)
                    }
                }, (response) => {
                    console.log(response)
                })
            },
            remove(row){
                if(confirm('Удалить?')){
                    this.$http.delete('/admin/categories/' + row.id).then((response) => {
                        if(response.status === 204){
                            this.$snackbar.open('Категория удалена!')
                            this.load()
                        }
                        else{
                            this.$snackbar.open('Ошибка!')
                        }
                    }, (response) => {
                        this.$snackbar.open('Ошибка!')
                        console.log(response)
                    })
                }
            }
        }
    }
</script>