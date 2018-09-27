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
                            :data="users"
                            paginated
                            narrowed=""
                            :loading="loading"
                            per-page="10"
                    >

                        <template slot-scope="props">
                            <b-table-column field="id" label="ID" width="40" sortable numeric>
                                {{ props.row.id }}
                            </b-table-column>

                            <b-table-column field="avatar" label="" width="90">
                                <img :class="['avatar-small']" :src="props.row.avatar" >
                            </b-table-column>

                            <b-table-column field="login" label="Login" sortable>
                                {{ props.row.login }}
                            </b-table-column>

                            <b-table-column field="email" label="Email" sortable>
                                {{ props.row.email }}
                            </b-table-column>

                            <b-table-column field="date" label="active_to" sortable centered>
                                <span class="tag"  :class="type(props.row.active_to)">
                                    {{ new Date(props.row.active_to).toLocaleDateString() }}
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
            return {
                users: [],
                search: '',
                loading: false
            }
        },
        components: {

        },
        mounted(){
            this.load()
        },
        methods: {
            load(){
                this.loading = true
                this.$http.get('/admin/users').then((response) => {
                    this.users = response.body
                    this.loading = false
                }, (response) => {
                    console.log(response)
                })
            },
            edit(row){
                this.$router.push({ name: 'Юзер', params: { id: row.id}})
            },
            remove(row){
                if (confirm('Удалить?')) {
                    this.$http.delete('/admin/users/' + row.id).then((response) => {
                        if (response.status === 204) {
                            this.$snackbar.open('Пользователь удален!')
                            this.load()
                        }
                        else {
                            this.$snackbar.open('Ошибка!')
                        }
                    }, (response) => {
                        this.$snackbar.open('Ошибка!')
                        console.log(response)
                    })
                }
            },
            find(){
                this.$http.get('/admin/users/search?q=' + this.search).then((response) => {
                    this.users = response.body
                }, (response) => {
                    this.$snackbar.open('Ошибка!')
                    console.log(response)
                })
            },
            type(value) {
                if (new Date(value) <  new Date()) {
                    return 'is-warning'
                } else {
                    return 'is-success'
                }
            }
        }
    }
</script>