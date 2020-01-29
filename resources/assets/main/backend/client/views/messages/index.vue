<template>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child box">
                    <b-table
                            :data="messages"
                            paginated
                            narrowed=""
                            :loading="loading"
                            :default-sort-direction="defaultSortDirection"
                            default-sort="id"
                            per-page="10"
                    >
                        <template slot-scope="props">
                            <b-table-column field="id" label="ID" width="40" sortable numeric>
                                {{ props.row.id }}
                            </b-table-column>

                            <b-table-column field="name" label="name" width="90">
                                {{ props.row.name }}
                            </b-table-column>

                            <b-table-column field="message" label="message" sortable>
                                {{ props.row.message }}
                            </b-table-column>

                            <b-table-column field="readed" label="readed" sortable>
                                {{ props.row.readed }}
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
        data() {
            return {
                messages: [],
                loading: false,
                defaultSortDirection: 'desc'
            }
        },
        components: {},
        mounted() {
            this.load()
        },
        methods: {
            load() {
                this.loading = true
                this.$http.get('/admin/message').then((response) => {
                    this.messages = response.body
                    this.loading = false
                }, (response) => {
                    console.log(response)
                })
            },
            see(row) {

            },
            remove(row) {
                this.$http.delete('/admin/message/' + row.id).then((response) => {
                    if (response.status === 204) {
                        this.$snackbar.open('Сообщение удалено!')
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
        }
    }
</script>