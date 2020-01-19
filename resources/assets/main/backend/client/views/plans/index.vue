<template>
    <div>
        <div class="tile is-ancestor">
            <div class="tile is-parent">
                <article class="tile is-child box">

                    <div class="tile is-parent">
                        <a class="button is-success" @click="add" >Добавить</a>
                    </div>

                    <b-table
                            :data="plans"
                            paginated
                            narrowed=""
                            :loading="loading"
                            per-page="10"
                    >

                        <template slot-scope="props">
                            <b-table-column field="id" label="ID" width="40" sortable numeric>
                                {{ props.row.id }}
                            </b-table-column>

                            <b-table-column field="name" label="name" width="90">
                                {{ props.row.name }}
                            </b-table-column>

                            <b-table-column field="period" label="period" sortable>
                                {{ props.row.period }}
                            </b-table-column>

                            <b-table-column field="cost" label="cost" sortable>
                                {{ props.row.cost }}
                            </b-table-column>

                            <b-table-column field="cost_per_month" label="cost_per_month" sortable>
                                {{ props.row.cost_per_month }}
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
                plans: [],
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
                this.$http.get('/admin/plan').then((response) => {
                    this.plans = response.body
                    this.loading = false
                }, (response) => {
                    console.log(response)
                })
            },
            edit(row){
                this.$router.push({ name: 'Тариф', params: { id: row.id}})
            },
            add(){
                this.$router.push({ name: 'Добавить тариф'})
            },
            remove(row){
                if (confirm('Удалить?')) {
                    this.$http.delete('/admin/plan/' + row.id).then((response) => {
                        if (response.status === 204) {
                            this.$snackbar.open('Тариф удален!')
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
    }
</script>