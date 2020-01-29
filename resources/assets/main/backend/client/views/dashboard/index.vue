<template>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <div v-if="loading" id="nprogress">
                        <div class="spinner-icon"></div>
                    </div>
                    <p class="title">{{users}}</p>
                    <p class="subtitle">Пользователей</p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <div v-if="loading" id="nprogress">
                        <div class="spinner-icon"></div>
                    </div>
                    <p class="title"></p>
                    <p class="subtitle"></p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <div v-if="loading" id="nprogress">
                        <div class="spinner-icon"></div>
                    </div>
                    <p class="title"></p>
                    <p class="subtitle"></p>
                </article>
            </div>
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <div v-if="loading" id="nprogress">
                        <div class="spinner-icon"></div>
                    </div>
                    <p class="title"></p>
                    <p class="subtitle"></p>
                </article>
            </div>
        </div>

        <div class="tile is-ancestor">
            <div class="tile is-parent is-12">
                <article class="tile is-child box">
                    <div v-if="loading" id="nprogress">
                        <div class="spinner-icon"></div>
                    </div>
                    <h4 class="title">Log</h4>
                    <b-table
                            :data="log"
                            paginated
                            narrowed=""
                            :loading="loading"
                            :default-sort-direction="defaultSortDirection"
                            default-sort="id"
                            per-page="20"
                    >

                        <template slot-scope="props">
                            <b-table-column field="id" label="ID" width="40" sortable numeric>
                                {{ props.row.id }}
                            </b-table-column>

                            <b-table-column field="description" label="Title" sortable>
                                {{ props.row.description }}
                            </b-table-column>

                            <b-table-column field="subject" label="subject" sortable>
                                {{ (props.row.subject) ? '' : '' }}
                            </b-table-column>

                            <b-table-column field="causer" label="causer" sortable>
                                {{ (props.row.causer) ? props.row.causer.login : '' }}
                            </b-table-column>

                            <b-table-column field="created_at" label="created_at" sortable centered>
                                <span class="tag"  :class="['light']">
                                    {{ new Date(props.row.created_at).toLocaleDateString()}} | {{new Date(props.row.created_at).toLocaleTimeString()}}
                                </span>
                            </b-table-column>

                            <b-table-column custom-key="actions">
                                <button class="button  is-success" @click="see(props.row)">
                                    <b-icon icon="eye-outline" size="is-small"></b-icon>
                                </button>
                                <button class="button  is-danger" @click="remove(props.row)">
                                    <b-icon icon="close-circle" size="is-small"></b-icon>
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
    export default {
        data () {
            return {
                users: 0,
                log: [],
                messages: [],
                loading: false,
                defaultSortDirection: 'desc'
            }
        },
        methods: {
            loadlog(){
                this.$http.get('/admin/log').then((response) => {
                    this.log = response.body
                }, (response) => {
                    console.log(response)
                })
            },
            remove(row){
                    this.$http.delete('/admin/log/' + row.id).then((response) => {
                        if (response.status === 204) {
                            this.$snackbar.open('Запись удалена!')
                            this.loadlog()
                        }
                        else{
                            this.$snackbar.open('Ошибка!')
                        }
                    }, (response) => {
                        this.$snackbar.open('Ошибка!')
                        console.log(response)
                    })
            },
            see(row){

            },
            deleteMessage (id) {
                this.$http.delete('/admin/message/' + id).then((response) => {
                    if (response.body.success) {
                        this.messages = response.body.messages
                        this.$snackbar.open('Удалено!')
                    } else {
                        this.$snackbar.open('Ошибка!')
                    }
                }, (response) => {
                    console.log(response)
                })
            }
        },
        mounted () {
            this.loading = true
            this.$http.get('/admin/dashboard').then((response) => {
                this.users = response.body.users
                this.log = response.body.log
                this.loading = false
            }, (response) => {
                console.log(response)
            })
        }
    }
</script>
