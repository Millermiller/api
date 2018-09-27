<template>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <div class="tile is-parent">
                        <a class="button is-success" @click="add" >Добавить</a>
                        <a class="button is-success" @click="find" >Найти</a>
                    </div>

                    <b-table
                            :data="pages"
                            paginated
                            narrowed=""
                            :loading="loading"
                            per-page="10"
                    >
                        <template slot-scope="props">
                            <b-table-column field="id" label="ID" width="40" sortable numeric>
                                {{ props.row.id }}
                            </b-table-column>

                            <b-table-column field="url" label="url" sortable>
                                {{ props.row.url }}
                            </b-table-column>

                            <b-table-column field="title" label="title" sortable>
                                {{ props.row.title }}
                            </b-table-column>

                            <b-table-column field="description" label="description" sortable>
                                {{ props.row.description }}
                            </b-table-column>

                            <b-table-column field="keywords" label="keywords" sortable>
                                {{ props.row.keywords }}
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
    </div>
</template>

<script>
    export default{
        data(){
            return{
                pages: [],
                newpage: {
                    url: '',
                    title: '',
                    description:'',
                    keywords: ''
                }
            }
        },

        mounted(){
            this.load()
        },
        methods: {
            load(){
                this.$http.get('/admin/meta').then((response) => {
                    this.pages = response.body
                }, (response) => {
                    console.log(response)
                })
            },
            add(){
                this.$router.push({ name: 'Добавить страницу'})
            },
            remove(row){
                if(confirm('Удалить?')){
                    this.$http.delete('/admin/meta/' + row.id).then((response) => {
                        if(response.status === 204){
                            this.$snackbar.open('Страница удалена!')
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
            },
            edit(row){
                this.$router.push({ name: 'Страница', params: { id: row.id}})
            },
            find(){
                this.$http.get('/admin/meta/search?q=' + this.search).then((response) => {
                    this.articles = response.body
                }, (response) => {
                    this.$snackbar.open('Ошибка!')
                    console.log(response)
                })
            }
        }
    }
</script>