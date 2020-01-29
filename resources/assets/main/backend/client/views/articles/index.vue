<template>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <b-field>
                        <b-input placeholder="Поиск..."
                                 type="search"
                                 icon="magnify"
                                 v-model="search">
                        </b-input>
                        <p class="control">
                            <button class="button is-info" @click="find">Search</button>
                        </p>
                    </b-field>

                    <b-table
                            :data="articles"
                            paginated
                            narrowed=""
                            :loading="loading"
                            per-page="10"
                    >

                        <template slot-scope="props">
                            <b-table-column field="id" label="ID" width="40" sortable numeric>
                                {{ props.row.id }}
                            </b-table-column>

                            <b-table-column field="title" label="Title" sortable>
                                {{ props.row.title }}
                            </b-table-column>

                            <b-table-column field="category.name" label="Category" sortable>
                                {{ props.row.category.name }}
                            </b-table-column>

                            <b-table-column field="views" label="Views" sortable centered>
                                {{ props.row.views }}
                            </b-table-column>

                            <b-table-column field="comments" label="comments" sortable centered>
                                {{ props.row.comments.length }}
                            </b-table-column>

                            <b-table-column field="status" label="status" sortable centered>
                                {{ props.row.status }}
                            </b-table-column>

                            <b-table-column field="created_at" label="created_at" sortable centered>
                                <span class="tag"  :class="['light']">
                                    {{ new Date(props.row.created_at).toLocaleDateString() }}
                                </span>
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
                articles: [],
                search: '',
            }
        },
        mounted(){
            this.load()
        },
        methods: {
            load(){
                this.$http.get('/admin/articles').then((response) => {
                    this.articles = response.body
                }, (response) => {
                    console.log(response)
                })
            },
            edit(row){
                this.$router.push({ name: 'Статья', params: { id: row.id}})
            },
            remove(row){
                if(confirm('Удалить?')){
                    this.$http.delete('/admin/articles/' + row.id).then((response) => {
                        if (response.status === 204) {
                            this.$snackbar.open('Статья удалена!')
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
            find(){
                this.$http.get('/admin/articles/search?q=' + this.search).then((response) => {
                    this.articles = response.body
                }, (response) => {
                    this.$snackbar.open('Ошибка!')
                    console.log(response)
                })
            }
        }
    }
</script>