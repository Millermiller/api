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
                            <button class="button is-info" @click="find">Поиск</button>
                        </p>
                    </b-field>

                    <b-table
                            :data="comments"
                            paginated
                            narrowed=""
                            :loading="loading"
                            per-page="10"
                    >
                        <template slot-scope="props">
                            <b-table-column field="id" label="ID" width="40" sortable numeric>
                                {{ props.row.id }}
                            </b-table-column>

                            <b-table-column field="post_id" label="Post" sortable>
                                {{ props.row.post_id }}
                            </b-table-column>

                            <b-table-column field="text" label="text" sortable>
                                {{ props.row.text }}
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
    import Vue from 'vue'

    export default{
        data(){
            return{
                comments: [],
                search: ''
            }
        },
        mounted(){
            this.load()
        },
        methods: {
            load(){
                let path = (this.$route.query.id) ? '/admin/comments?id='+this.$route.query.id : '/admin/comments'
                this.$http.get(path).then((response) => {
                    this.comments = response.body
                }, (response) => {
                    console.log(response)
                })
            },
            remove(id){
                if(confirm('Удалить?')){
                    this.$http.delete('/admin/comments/'+id).then((response) => {
                        if(response.status === 204){
                            this.$snackbar.open('Комментарий удален!')
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
                this.$http.get('/admin/comments/search?q='+this.search).then((response) => {
                    this.comments = response.body
                }, (response) => {
                    this.$snackbar.open('Ошибка!')
                    console.log(response)
                })
            }
        }
    }
</script>